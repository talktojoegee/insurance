<?php

namespace Modules\Policy\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use Modules\Policy\Entities\Client;
use Modules\Policy\Entities\BusinessClass;
use Modules\Policy\Entities\SubBusinessClass;
use Modules\Policy\Entities\Agent;
use Modules\Policy\Entities\Policy;
use Modules\Policy\Entities\DebitNote as dNote;
use Modules\Accounting\Entities\Currency;

class DebitNote extends Model
{
    protected $fillable = [];


    public function getBusinessClass(){
    	return $this->belongsTo(BusinessClass::class, 'class_id');
    }
    public function getSubBusinessClass(){
    	return $this->belongsTo(SubBusinessClass::class, 'sub_class_id');
    }
    public function getAgency(){
    	return $this->belongsTo(Agent::class, 'agency_id');
    }
    public function getClient(){
    	return $this->belongsTo(Client::class, 'client_id');
    }
    public function getPolicy(){
    	return $this->belongsTo(Policy::class, 'policy_no', 'policy_number');
    }
    public function getCurrency(){
    	return $this->belongsTo(Currency::class, 'currency');
    }


    public function getDebitNotes(){
        return dNote::orderBy('id', 'DESC')->get();
    }

    public function getLastDebitNote(){
        return dNote::orderBy('id', 'DESC')->first();
    }

    public function getDebitNoteBySlug($slug){
        return dNote::where('slug', $slug)->first();
    }


    public function createDebitNote(Request $request, $agency_id){

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
        $debit->class_id = $request->class;
        $debit->sub_class_id = $request->sub_class;
        $debit->sum_insured = $request->sum_insured;
        $debit->premium_rate = $request->premium_rate;
        $debit->commission_rate = $request->commission_rate;
        $debit->agency_id = $agency_id;
        //$debit->vat = $request->vat;
        $debit->net_amount = $request->net_amount;
        $debit->commission = $request->commission;
        $debit->gross_premium = $request->gross_premium;
        $debit->exchange_rate = $request->exchange_rate;
        $debit->currency = $request->currency;
        $debit->payment_mode = $request->payment_mode;
        $debit->start_date = $current_date;
        $debit->end_date = $current_date->addDays($cover_days);
        $debit->client_id = $request->client;
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
        return $debit;
    }
}
