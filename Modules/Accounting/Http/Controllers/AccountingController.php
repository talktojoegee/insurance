<?php

namespace Modules\Accounting\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Accounting\Entities\Coa;
use Modules\Accounting\Entities\Currency;
use Modules\Accounting\Entities\Receipt;
use Modules\Accounting\Entities\Invoice;
use Modules\Accounting\Entities\GeneralLedger;
use Modules\Policy\Entities\DebitNote;
use Modules\CompanySettings\Entities\SettingsAccount;
use Carbon\Carbon;
use Auth;
use DB;

class AccountingController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $charts = Coa::all();
        return view('accounting::index', ['charts'=>$charts]);
    }

    public function getParentAccount(Request $request){
         $request->validate($request,[
            'account_type'=>'required'
        ]);
        $accounts = Coa::select('account_name', 'id', 'type', 'glcode')
            ->where('type',1)
            ->where('account_type',$request->account_type)
            ->get();
        return view('accounting::partials._accounts', ['accounts'=>$accounts]);
    }
    public function saveAccount(Request $request){
         $request->validate($request,[
            "glcode"=>"required|unique:coa,glcode",
            "account_type"=>"required",
            "type"=>"required",
            "bank"=>"required",
            "parent_account"=>"required"
            ]);
        $coa = DB::table('coas')->insert($request->all());
        return response()->json(['message'=>'Success! New account registered.'], 200);
    }
    public function journalVoucher()
    {
        $entries =  DB::table('coas as c')
                        ->join('journal_vouchers as j', 'j.glcode', '=', 'c.glcode')
                        ->join('users as u', 'u.id', '=', 'j.entry_by')
                        ->select('c.*', 'j.*', 'u.first_name', 'u.last_name')
                        ->where('j.trash',0)
                        ->where('j.posted',0)
                        ->get();
        return view('accounting::jv', ['entries'=>$entries]);
    }
    public function newJournalVoucher()
    {
        $accounts = Coa::all();
        return view('accounting::jv-new', ['accounts'=>$accounts]);
    }


    public function accountSettings(){
        $accounts = Coa::where('type',2)->get(); //detail account
        $settings = SettingsAccount::get();
        return view('accounting::settings', ['accounts'=>$accounts, 'settings'=>$settings]);
    }

    public function setDefaultAccounts(Request $request){
        /* $request->validate([
            'transaction.*'=>'required|array',
            'credit.*'=>'required|array',
            'debit.*'=>'required|array'
        ]); */
        $settings = SettingsAccount::truncate();
        for($i = 0; $i<count($request->transaction); $i++){
            $settings = new SettingsAccount;
            $settings->transaction = $request->transaction[$i];
            $settings->dr = $request->debit[$i];
            $settings->cr = $request->credit[$i];
            $settings->save();
        }
        session()->flash("success", "<strong>Success!</strong> Default accounts registered.");
        return back();
    }


    public function showGenerateReceipt(){
        $accounts = Coa::all();
        $currencies = Currency::all();
        $receiptNo = null;
        $receipt = Receipt::orderBy('id', 'DESC')->first();
        if(!empty($receipt)){
            $receiptNo = $receipt->receipt_no + 1;
        }else{
            $receiptNo = 10000;
        }
        return view('accounting::receipt.generate-receipt',['currencies'=>$currencies,'accounts'=>$accounts,'receiptNo'=>$receiptNo]);
    }

    public function storeReceipt(Request $request){
        $request->validate([
            'debit_code'=>'required',
            'receipt_no'=>'required',
            'bank'=>'required',
            'transaction_date'=>'required|date',
            'payment_type'=>'required',
            'payment_mode'=>'required',
            'currency'=>'required',
            'amount'=>'required'
        ]);
        $transaction = substr(sha1(time()),30,40);
        $receipt = new Receipt;
        $receipt->receipt_no = $request->receipt_no;
        $receipt->debit_code = $request->debit_code;
        $receipt->glcode = $request->bank;
        $receipt->created_at = $request->transaction_date;
        $receipt->payment_type = $request->payment_type;
        $receipt->payment_mode = $request->payment_mode;
        $receipt->currency_id = $request->currency;
        $receipt->amount = $request->amount;
        $receipt->transaction_id = $transaction;
        $receipt->save();
        #post to ledger
        $default_receipt_account = SettingsAccount::where('transaction', 'client')->first();
        if(!empty($default_receipt_account)){
            //debit bank
            $ledger = new GeneralLedger;
            $ledger->glcode = $request->bank;
            $ledger->dr_amount = $request->amount ?? 0;
            $ledger->cr_amount = 0;
            $ledger->posted_by = \Auth::user()->id;
            $ledger->narration = "Receipt generated with debit code <strong>".$request->debit_code."</strong>";
            $ledger->ref_no = $transaction;
            $ledger->save();
            //credit client
            $ledger = new GeneralLedger;
            $ledger->glcode = $default_receipt_account->cr;
            $ledger->dr_amount = 0;
            $ledger->cr_amount = $request->amount ?? 0;
            $ledger->posted_by = \Auth::user()->id;
            $ledger->narration = "Receipt generated with debit code <strong>".$request->debit_code."</strong>";
            $ledger->ref_no = $transaction;
            $ledger->save();
            session()->flash("success", "<strong>Success!</strong> Receipt generated.");
            return redirect("/accounting/receipts");
        }else{
            return redirect("/accounting/receipts");
        }
    }

    public function receipts(){
        $receipts = Receipt::orderBy('id', 'DESC')->get();
        return view('accounting::receipt.receipts', ['receipts'=>$receipts]);
    }

    public function getDebitNoteDetails(Request $request){
        $request->validate([
            'debit_code'=>'required'
        ]);
        $debit_note = DebitNote::where('debit_code', $request->debit_code)->first();
        if(!empty($debit_note)){
            return view('accounting::receipt.common._debit-note-details',['debit_note'=>$debit_note]);
        }else{
            return "<p class='text-center text-danger p-2' style='font-weight:700;'>No record found.</p>";
        }
    }



    public function trialBalanceView(){
        return view('accounting::report.accounting-period');
    }


    public function trialBalance(Request $request){
        $messages = [
            'to'=>'Choose :attribute your account start period',
            'from'=>'Choose :attribute account closing period'
        ];
        $request->validate([
            'from'=>'required|date',
            'to'=>'required|date|after_or_equal:from'
        ], $messages);
        $current = Carbon::now();
        $inception = DB::table('general_ledgers')->orderBy('id', 'ASC')->first();
        if(!empty($inception)){
            $bfDr = DB::table('general_ledgers')->whereBetween('created_at', [$inception->created_at, $current->parse($request->from)->subDays(1)])->sum('dr_amount');
            $bfCr = DB::table('general_ledgers')->whereBetween('created_at', [$inception->created_at, $current->parse($request->from)->subDays(1)])->sum('cr_amount');
            $reports = DB::table('general_ledgers as g')
                ->join('coas as c', 'c.glcode', '=', 'g.glcode')
                ->select(DB::raw('sum(g.dr_amount) AS sumDebit'),DB::raw('sum(g.cr_amount) AS sumCredit'),
                    'c.account_name', 'g.glcode', 'c.glcode', 'c.account_type', 'c.type')
                //->where('c.account_type', 1)
                ->where('c.type', 1)
                ->whereBetween('g.created_at', [$request->from, $request->to])
                ->orderBy('c.account_type', 'ASC')
                ->groupBy('c.account_name')
                ->get();
            return view('backend.accounting.reports.trial-balance', [
                'reports'=>$reports,
                'bfDr'=>$bfDr,
                'bfCr'=>$bfCr,
                'from'=>$request->from,
                'to'=>$request->to
            ]);
        }else{
            session()->flash("error", "<strong>Ooops!</strong> No record found.");
            return back();
        }
    }

    public function balanceSheetView(){
        return view('accounting::report.balance-sheet-setup');
    }
    public function balanceSheet(Request $request){
        $request->validate([
            'date'=>'required|date'
        ]);
        $current = Carbon::now();
        $inception = DB::table('general_ledgers')->orderBy('id', 'ASC')->first();
        if(!empty($inception)){
            $bfDr = DB::table('general_ledgers')->whereBetween('created_at', [$inception->created_at,$request->date])->sum('dr_amount');
            $bfCr = DB::table('general_ledgers')->whereBetween('created_at',[$inception->created_at,$request->date])->sum('cr_amount');
            $reports = DB::table('general_ledgers as g')
                ->join('coas as c', 'c.glcode', '=', 'g.glcode')
                ->select(DB::raw('sum(g.dr_amount) AS sumDebit'),DB::raw('sum(g.cr_amount) AS sumCredit'),
                    'c.account_name', 'g.glcode', 'c.glcode', 'c.account_type', 'c.type')
                ->where('c.type', 1)
                ->whereBetween('g.created_at', [$inception->created_at,$request->date])
                ->orderBy('c.account_type', 'ASC')
                ->groupBy('c.account_name')
                ->get();
            $revenue = DB::table('general_ledgers as g')
                            ->join('coas as c', 'c.glcode', '=', 'g.glcode')
                            ->where('c.type', 1)
                            ->whereIn('c.account_type', [4])
                            ->whereBetween('g.created_at', [$inception->created_at,$request->date])
                            ->get();
            $expense = DB::table('general_ledgers as g')
                            ->join('coas as c', 'c.glcode', '=', 'g.glcode')
                            ->where('c.type', 1)
                            ->whereIn('c.account_type', [5])
                            ->whereBetween('g.created_at', [$inception->created_at,$request->date])
                            ->get();
            return view('accounting::report.balance-sheet', [
                'reports'=>$reports,
                'bfDr'=>$bfDr,
                'bfCr'=>$bfCr,
                'date'=>$request->date,
                'revenue'=>$revenue,
                'expense'=>$expense
            ]);
        }else{
            session()->flash("error", "<strong>Ooops!</strong> No record found.");
            return back();
        }
    }
    public function profitOrLossView(){
        return view('accounting::report.profit-or-loss-setup');
    }

    public function profitOrLoss(Request $request){
        $messages = [
            'to'=>'Choose :attribute your account start period',
            'from'=>'Choose :attribute account closing period'
        ];
        $request->validate([
            'from'=>'required|date',
            'to'=>'required|date|after_or_equal:from'
        ], $messages);
        $current = Carbon::now();
        $inception = DB::table('general_ledgers')->orderBy('id', 'ASC')->first();
        if(!empty($inception)){
            $bfDr = DB::table('general_ledgers')->whereBetween('created_at', [$inception->created_at, $current->parse($request->from)->subDays(1)])->sum('dr_amount');
            $bfCr = DB::table('general_ledgers')->whereBetween('created_at', [$inception->created_at, $current->parse($request->from)->subDays(1)])->sum('cr_amount');
            $reports = DB::table('general_ledgers as g')
                ->join('coas as c', 'c.glcode', '=', 'g.glcode')
                ->select(DB::raw('sum(g.dr_amount) AS sumDebit'),DB::raw('sum(g.cr_amount) AS sumCredit'),
                    'c.account_name', 'g.glcode', 'c.glcode', 'c.account_type', 'c.type')
                ->where('c.type', 1)
                ->whereBetween('g.created_at', [$request->from, $request->to])
                ->orderBy('c.account_type', 'ASC')
                ->groupBy('c.account_name')
                ->get();
            $revenue = DB::table('general_ledgers as g')
                            ->join('coas as c', 'c.glcode', '=', 'g.glcode')
                            ->where('c.type', 1)
                            ->whereIn('c.account_type', [4])
                            ->whereBetween('g.created_at', [$request->from, $request->to])
                            ->get();
            $expense = DB::table('general_ledgers as g')
                            ->join('coas as c', 'c.glcode', '=', 'g.glcode')
                            ->where('c.type', 1)
                            ->whereIn('c.account_type', [5])
                            ->whereBetween('g.created_at', [$request->from, $request->to])
                            ->get();
            return view('accounting::report.profit-or-loss',[
                'reports'=>$reports,
                'bfDr'=>$bfDr,
                'bfCr'=>$bfCr,
                'from'=>$request->from,
                'to'=>$request->to,
                'revenue'=>$revenue,
                'expense'=>$expense
            ]);
        }else{
            session()->flash("error", "<strong>Ooops!</strong> No record found.");
            return back();
        }
    }
}
