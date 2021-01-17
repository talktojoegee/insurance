<?php

namespace Modules\Policy\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Policy\Entities\Policy;
use Modules\Policy\Entities\DebitNote;
use Modules\Accounting\Entities\Currency;
use Modules\Policy\Entities\SettingsAccount;
use Carbon\Carbon;
use Auth;

class DebitNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $list = DebitNote::orderBy('id', 'DESC')->get();
        return view('policy::debit-note.index', ['list'=>$list]);
    }

    public function create($slug){
        $policy = Policy::where('slug', $slug)->first();
        if(!empty($policy)){
            $debitCode = null;
            $debit = DebitNote::orderBy('id', 'DESC')->first();
            $currencies = Currency::orderBy('name', 'ASC')->get();
            if(!empty($debit)){
                $debitCode =$debit->debit_code + 1;
            }else{
                $debitCode = 100000;
            }
            return view('policy::debit-note.create', ['policy'=>$policy, 'debitCode'=>$debitCode,'currencies'=>$currencies]);
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
    public function storeNewDebitNote(Request $request)
    {

        $request->validate([
    		'debit_code_number'=>'required|unique:debit_notes,debit_code',
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
        $cover_days = $current_date->diffInDays($request->end_date);
        $trans_id = strtoupper(substr(md5(time()), 0,10));

    	$debit = new DebitNote;
    	$debit->policy_no = $request->policy_number;
    	$debit->debit_code = $request->debit_code_number;
    	//$debit->insured_name = $request->insured_name;
    	//$debit->address = $request->address;
    	//$debit->narration = $request->narration;
    	$debit->business_type = $request->business_type;
    	$debit->option = $request->option;
    	//$debit->business_class = $request->class;
    	//$debit->sub_class = $request->sub_class;
    	$debit->sum_insured = $request->sum_insured;
    	$debit->premium_rate = $request->premium_rate;
    	$debit->commission_rate = $request->commission_rate;
    	//$debit->vat = $request->vat;
    	$debit->net_amount = $request->net_amount;
    	$debit->commission = $request->commission;
    	$debit->gross_premium = $request->gross_premium;
    	$debit->exchange_rate = $request->exchange_rate;
    	$debit->currency = $request->currency;
        $debit->payment_mode = $request->payment_mode;
        $debit->start_date = $current_date;
        $debit->end_date = $current_date->addDays($cover_days);
        $debit->client_id = 1;
        $debit->slug = substr(sha1(time()),30,40);
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
        $debit->save();
        #Register debit note
        /* $debitAccount = SettingsAccount::where('transaction', 'debit-note')->first();
        $creditAccount = SettingsAccount::where('transaction', 'credit-note')->first(); */
        session()->flash("success", "<strong>Success!</strong> Debit note registered. Pending approval.");
        return redirect('/policy/debite-notes');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function view($slug)
    {
        $debit = DebitNote::where('slug', $slug)->first();
        if(!empty($debit)){
            return view('policy::debit-note.view',['debit'=>$debit]);
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
