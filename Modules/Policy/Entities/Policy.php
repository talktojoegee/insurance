<?php

namespace Modules\Policy\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Policy\Entities\Client;
use Modules\Policy\Entities\BusinessClass;
use Modules\Policy\Entities\SubBusinessClass;
use Modules\Policy\Entities\Agent;
use Modules\Accounting\Entities\Currency;

class Policy extends Model
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
    public function getCurrency(){
    	return $this->belongsTo(Currency::class, 'currency');
    }
    public function getVehicles(){
    	return $this->hasMany(VehicleInfo::class, 'policy_no', 'policy_number');
    }





    public function getPolicyDocumentationByType($type){
        return Policy::where('policy_type', $type)->orderBy('id', 'DESC')->get();
    }

    public function createPolicyDocumentation(Request $request, $clientId){
        $policy = new Policy;
        $policy->policy_number = $request->policy_number;
        $policy->insurance_policy_number = $request->insurance_policy_number;
        $policy->start_date = $request->start_date;
        $policy->end_date = $request->end_date;
        $policy->policy_type = $request->policy_type;
        $policy->client_id = $clientId;
        $policy->sum_insured = $request->sum_insured;
        $policy->premium_rate =   $request->premium_rate;
        $policy->gross_premium = ceil(($request->premium_rate/100)*$request->sum_insured);
        $policy->currency = $request->currency;
        $policy->author = Auth::user()->id;
        $policy->class_id = $request->business_class;
        $policy->sub_class_id = $request->sub_business_class;
        $policy->agency_id = $request->agent;
        $policy->slug = substr(sha1(time()),29,40 );
        $policy->save();
        return $policy;
    }

    public function getPolicyBySlug($slug){
        return Policy::where('slug', $slug)->first();
    }

    public function getPolicyById($id){
        return Policy::find($id);
    }

    public function getPolicyByPolicyNo($number){
        return Policy::where('policy_number', $number)->first();
    }

    public function getAllPolicies(){
        return Policy::orderBy('id', 'DESC')->get();
    }
    public function getThisYearPolicyListings(){
        return Policy::whereYear('created_at', date('Y'))->orderBy('id', 'DESC')->get();
    }
    public function getThisYearPolicies(){
        return Policy::select(
            DB::raw("count(policy_number) as counter"),
            DB::raw("DATE_FORMAT(created_at, '%m-%Y') monthYear"),
            DB::raw("YEAR(created_at) year, MONTH(created_at) month"),
            'policy_type',
            //DB::raw("YEAR(created_at) year, MONTH(created_at) month"))
            //DB::raw("date(created_at) as ")
        )->whereYear('created_at', date('Y'))->orderBy('id', 'DESC')
            ->orderBy('month', 'ASC')
            ->groupby('year','month', 'policy_type')
            ->get();
    }
}
//select(DB::raw('count(id) as `data`'),
// DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"),
//  DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
//->groupby('year','month')
//->get();
