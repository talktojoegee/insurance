<?php

namespace Modules\Policy\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Policy\Entities\Policy;
use Modules\Policy\Entities\CreditNote;
use Modules\Policy\Entities\DebitNote;
use Modules\Accounting\Entities\Currency;
use Modules\Policy\Entities\SettingsAccount;
use Carbon\Carbon;
use Auth;

class CreditNoteController extends Controller
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
        $list = CreditNote::orderBy('id', 'DESC')->get();
        return view('policy::credit-note.index', ['list'=>$list]);
    }

    public function create($slug){
        $debit = DebitNote::where('slug', $slug)->first();
        //return dd($debit);
        if(!empty($debit)){
            $creditCode = null;
            $credit = CreditNote::orderBy('id', 'DESC')->first();
            $currencies = Currency::orderBy('name', 'ASC')->get();
            if(!empty($credit)){
                $creditCode =$credit->Credit_code + 1;
            }else{
                $creditCode = 100000;
            }
            return view('policy::credit-note.create', ['debit'=>$debit, 'creditCode'=>$creditCode,'currencies'=>$currencies]);
        }else{
            session()->flash("error", "<strong>Ooops!</strong> Record not found.");
            return back();
        }
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function storeNewCreditNote(Request $request)
    {
        $request->validate([
    		'credit_code'=>'required|unique:credit_notes,credit_code',
    		'sum_insured'=>'required',
    		'premium_rate'=>'required',
    		'commission_rate'=>'required',
    		'payment_mode'=>'required',
    		'net_amount'=>'required',
    		'gross_premium'=>'required',
            'commission'=>'required',
            'policy_number'=>'required',
            'business_type'=>'required',
            'option'=>'required',
            'currency'=>'required'
    	]);

    	$current_date = Carbon::createFromDate($request->start_date);
        $trans_id = strtoupper(substr(md5(time()), 0,10));

    	$credit = new CreditNote;
    	$credit->policy_no = $request->policy;
    	$credit->debit_code = $request->debit_code_number;
    	$credit->credit_code = $request->credit_code;
    	//$debit->insured_name = $request->insured_name;
    	$credit->sub_class_id = $request->sub_business_class;
    	$credit->class_id = $request->business_class;
    	$credit->agency_id = $request->agent;
    	$credit->narration = $request->narration ?? '';
    	$credit->business_type = $request->business_type;
    	$credit->option = $request->option;
    	//$debit->business_class = $request->class;
    	//$debit->sub_class = $request->sub_class;
    	$credit->sum_insured = $request->sum_insured;
    	$credit->premium_rate = $request->premium_rate;
    	$credit->commission_rate = $request->commission_rate;
    	//$debit->vat = $request->vat;
    	$credit->net_amount = $request->net_amount;
    	$credit->commission = $request->commission;
    	$credit->gross_premium = $request->gross_premium;
    	$credit->exchange_rate = $request->exchange_rate;
    	$credit->currency = $request->currency;
        $credit->payment_mode = $request->payment_mode;
        $credit->client_id = $request->client;
        $credit->slug = substr(sha1(time()),30,40);
    	//$debit->reference_no = $request->reference_no;
    	//$debit->cheque_no = $request->cheque_no;
    	//$debit->leave_note = $request->leave_note;
    	//$debit->vat_rate = $request->vat_rate;
    	//$debit->start_date = $request->start_date;
    	//$debit->cover_days = $request->cover_days;
        //$debit->created_at = $request->transaction_date;
    	//$debit->end_date = $current_date->addDays($request->cover_days);
        //$debit->transaction_id = $trans_id;
        //$debit->insurance_company = $request->insurance_company;
        $credit->save();
        #Register debit note
        /* $debitAccount = SettingsAccount::where('transaction', 'debit-note')->first();
        $creditAccount = SettingsAccount::where('transaction', 'credit-note')->first(); */
        session()->flash("success", "<strong>Success!</strong> Credit note registered. Pending approval.");
        return redirect('policy/credit-notes');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function view($slug)
    {
        $credit = CreditNote::where('slug', $slug)->first();
        if(!empty($credit)){
            return view('policy::credit-note.view',['credit'=>$credit]);
        }else{
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('policy::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
