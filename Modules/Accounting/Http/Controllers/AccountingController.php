<?php

namespace Modules\Accounting\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Accounting\Entities\Coa;
use Modules\CompanySettings\Entities\SettingsAccount;
use Auth;
use DB;

class AccountingController extends Controller
{
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
}
