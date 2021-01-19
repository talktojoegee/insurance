<?php

namespace Modules\Policy\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Policy\Entities\Client;
use Modules\Accounting\Entities\Currency;
use Modules\Policy\Entities\Policy;
use Modules\Policy\Entities\Claim;
use Modules\Policy\Entities\ClaimAttachment;

class ClaimController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {   $claims = Claim::orderBy('id', 'DESC')->get();
        return view('policy::claims.index',['claims'=>$claims]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
            $claimNo = null;
            $claim = Claim::orderBy('id', 'DESC')->first();
            $currencies = Currency::orderBy('name', 'ASC')->get();
            if(!empty($claim)){
                $claimNo =$claim->claim_no + 1;
            }else{
                $claimNo = 100000;
            }
            $clients = Client::orderBy('insured_name', 'ASC')->get();
            return view('policy::claims.create',['clients'=>$clients, 'currencies'=>$currencies, 'claimNo'=>$claimNo]);
    }

    public function getClientPolicies(Request $request){
        $request->validate([
            'client'=>'required'
        ]);
        $policies = Policy::where('client_id', $request->client)->get();
        if(!empty($policies)){
            return view('policy::claims.partials._policies',['policies'=>$policies]);
        }else{

            return "";
        }
    }
    public function getClientPolicy(Request $request){
        $request->validate([
            'client'=>'required',
            'policy'=>'required'
        ]);
        $policy = Policy::where('client_id', $request->client)->where('policy_number', $request->policy)->first();
        if(!empty($policy)){
            return view('policy::claims.partials._policy',['policy'=>$policy]);
        }else{
            return "<p class='text-center text-danger p-2' style='font-weight:700;'>No record found.</p>";

        }
    }

    public function storeClaim(Request $request){
        $request->validate([
            'claim_no'=>'required|unique:claims,claim_no',
            'insured_name'=>'required',
            'policy_no'=>'required',
            'insurance_claim_no'=>'required',
            'date_of_loss'=>'required|date',
            'date_of_notification'=>'required|date|after_or_equal:date_of_loss',
            'estimated_claim_amount'=>'required',
            'claim_attachment_documents.*'=>'required'
        ]);
        $policy = Policy::where('client_id', $request->insured_name)->where('policy_number', $request->policy_no)->first();
        if(!empty($policy)){
            $claim = new Claim;
            $claim->class_id = $policy->class_id;
            $claim->sub_class_id = $policy->sub_class_id;
            $claim->insurance_company = $policy->agency_id;
            $claim->policy_no = $request->policy_no;
            $claim->insurance_claim_no = $request->insurance_claim_no;
            $claim->estimated_claim_amount = $request->estimated_claim_amount ?? 0;
            $claim->client_id = $request->insured_name; //this is actually an ID
            $claim->claim_no = $request->claim_no;
            $claim->notification_date = $request->date_of_notification;
            $claim->loss_date = $request->date_of_loss;
            $claim->claim_description = $request->claim_description;
            $claim->submitted_by = \Auth::user()->id;
            $claim->save();
            $claimId = $claim->id;
            #Attachment
            if(!is_null($request->claim_attachment_documents) && count($request->claim_attachment_documents) > 0){
                foreach($request->file('claim_attachment_documents') as $file)
                {
                    $name = time().'.'.$file->extension();
                    $file->move(public_path().'/assets/attachments/', $name);
                    $data[] = $name;
                    $attachment = new ClaimAttachment;
                    $attachment->claim_id = $claimId;
                    $attachment->attachment = $name;
                    $attachment->save();
                }
            }
            session()->flash("success", "<strong>Success!</strong> Claim submitted.");
            return redirect('/policy/claims');

        }else{
            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('policy::show');
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
