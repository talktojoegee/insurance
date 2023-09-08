<?php

namespace Modules\Policy\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;
use Modules\Policy\Entities\Agent;
use Modules\Policy\Entities\CreditNote;
use Modules\Policy\Entities\DebitNote;
use Modules\Policy\Entities\Policy;
use Modules\Policy\Entities\Client;
use Modules\Policy\Entities\BusinessClass;
use Modules\Policy\Entities\SubBusinessClass;
use Modules\Policy\Entities\Cover;
use Modules\Policy\Entities\Make;
use Modules\Policy\Entities\State;
use Modules\Policy\Entities\VehicleInfo;
use Modules\Accounting\Entities\Currency;
use Auth;

class PolicyController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->policy = new Policy();
        $this->client = new Client();
        $this->debitnote = new DebitNote();
        $this->creditnote = new CreditNote();
    }

    public function dashboard(){
        return view('policy::dashboard',[
            'policies'=>$this->policy->getThisYearPolicyListings(),
            'clients'=>$this->client->getThisYearClients(),
            'debitNotes'=>$this->debitnote->getThisYearDebitNotes(),
            'creditNotes'=>$this->creditnote->getThisYearCreditNotes()
        ]);
    }

    public function dashboardStatistics(){
        $report = $this->policy->getThisYearPolicies();
        return response()->json($report,200);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $policies = $this->policy->getPolicyDocumentationByType(1);
        return view('policy::non-motor',
            [
                'policies'=>$policies,
                'thisYearPolicies'=>$this->policy->getThisYearPolicyDocumentationByType(1)
            ]);
    }
    public function nonMotor()
    {
        $policies = $this->policy->getPolicyDocumentationByType(1);
        //Policy::where('policy_type', 1)->orderBy('id', 'DESC')->get();
        return view('policy::non-motor',['policies'=>$policies]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {

        return view('policy::create');
    }
    public function getSubBusinessClasses(Request $request){
        $sub_classes = SubBusinessClass::where('business_class_id', $request->id)->get();
        return response()->json(['sub_business_classes'=>$sub_classes], 200);
    }
    public function initializeInstance(){
        $policy = Policy::orderBy('id', 'DESC')->first();
        $policyNumber = null;
        if(!empty($policy)){
            $policyNumber =$policy->policy_number + 1;
        }else{
            $policyNumber = 100000; //use GUI to set up policy, start #, debit, credit note, receipt, invoice,
        }
        $agents = Agent::orderBy('agent_name', 'ASC')->get();
        $classes = BusinessClass::orderBy('class_name', 'ASC')->get();
        $clients = Client::orderBy('insured_name', 'ASC')->get();
        $covers = Cover::orderBy('cover_type', 'ASC')->get();
        $makes = Make::orderBy('make_name', 'ASC')->get();
        $states = State::orderBy('state_name', 'ASC')->get();
        $currencies = Currency::orderBy('name', 'ASC')->get();
        return response()->json([
            'agents'=>$agents,
            'classes'=>$classes,
            'policyNumber'=>$policyNumber,
            'clients'=>$clients,
            'states'=>$states,
            'makes'=>$makes,
            'covers'=>$covers,
            'currencies'=>$currencies
        ],200);
    }

    public function createMotorPolicy()
    {
        $policy = Policy::orderBy('id', 'DESC')->first();
        $policyNumber = null;
        if(!empty($policy)){
            $policyNumber =$policy->policy_number + 1;
        }else{
            $policyNumber = 100000; //use GUI to set up policy, start #, debit, credit note, receipt, invoice,
        }
        $agents = Agent::orderBy('agent_name', 'ASC')->get();
        $classes = BusinessClass::orderBy('class_name', 'ASC')->get();
        return view('policy::create-motor', ['agents'=>$agents, 'classes'=>$classes,'policyNumber'=>$policyNumber]);
    }

    public function motor()
    {
        $policies = $this->policy->getPolicyDocumentationByType(2);
        return view('policy::motor',[
            'policies'=>$policies,
            'thisYearPolicies'=>$this->policy->getThisYearPolicyDocumentationByType(2)
        ]);
    }
    public function store(Request $request)
    {

        $request->validate([
            'documentation_for'=>'required',
            'policy_type'=>'required',
            'business_class'=>'required',
            'sub_business_class'=>'required',
            'agent'=>'required'
        ]);
        if($request->documentation_for == 1){ //existing client
            $request->validate([
                'policy_number'=>'required|unique:policies,policy_number',
                'insurance_policy_number'=>'required',
                'start_date'=>'required|date',
                'end_date'=>'required|date',
                'policy_type'=>'required',
                'client'=>'required',
                'sum_insured'=>'required',
                'premium_rate'=>'required',
                'gross_premium'=>'required',
                'currency'=>'required'
            ]);
            $this->policy->createPolicyDocumentation($request, $request->client);

        }else{ //new client
            $request->validate([
                'policy_number'=>'required|unique:policies,policy_number',
                'insurance_policy_number'=>'required',
                'start_date'=>'required|date',
                'end_date'=>'required|date',
                'policy_type'=>'required',
                'insured_name'=>'required',
                'email'=>'required|email|unique:clients,email',
                'mobile_number'=>'required',
                'address'=>'required',
                'sum_insured'=>'required',
                'premium_rate'=>'required',
                'gross_premium'=>'required',
                'currency'=>'required'
            ]);
            $client = $this->client->createClient($request);
            /*$client = new Client;
            $client->insured_name = $request->insured_name;
            $client->email = $request->email;
            $client->mobile_no = $request->mobile_number;
            $client->address = $request->address;
            $client->password = bcrypt(substr(sha1(time()),32,40 ));
            $client->slug = substr(sha1(time()),24,40 );
            $client->save();*/

            $new_policy = $this->policy->createPolicyDocumentation($request, $client->id);

            /*$policy = new Policy;
            $policy->policy_number = $request->policy_number;
            $policy->insurance_policy_number = $request->insurance_policy_number;
            $policy->start_date = $request->start_date;
            $policy->end_date = $request->end_date;
            $policy->policy_type = $request->policy_type;
            $policy->client_id = $client->id;
            $policy->sum_insured = $request->sum_insured;
            $policy->premium_rate = $request->premium_rate;
            $policy->gross_premium = $request->gross_premium;
            $policy->currency = $request->currency;
            $policy->author = 1;
            $policy->policy_type = $request->policy_type;
            $policy->class_id = $request->business_class;
            $policy->sub_class_id = $request->sub_business_class;
            $policy->agency_id = $request->agent;
            $policy->slug = $policy->slug = substr(sha1(time()),29,40 );
            $policy->save();*/
        }
        if($request->policy_type == 2){ //motor
	        //save vehicles
            $veh = null;
            $data = [];
            foreach($request->vehicle as $veh){
            $data[] = [
                    'policy_no' => $request->policy_number,
                    'cover_type' => $veh['cover_type'],
                    'reg_no' => $veh['reg_no'],
                    'state_issued' => $veh['state_issued'],
                    'vehicle_make' => $veh['make'],
                    'engine_no' => $veh['engine_no'],
                    'chassis_no' => $veh['chassis_no'],
                    'vehicle_value' => $veh['vehicle_value'],
                ];
            }
            VehicleInfo::insert($data);
        }
        session()->flash("success", "<strong>Success!</strong> Policy  documented.");
        return redirect('/policy');
    }

    public function clients(){
        $clients = Client::orderBy('insured_name', 'ASC')->get();
        return view('policy::clients.index',
            [
                'clients'=>$clients,
                'thisMonthClients'=>$this->client->getThisMonthClients(),
                'lastMonthClients'=>$this->client->getLastMonthClients(),
                'thisWeekClients'=>$this->client->getThisWeekClients()
            ]);
    }
    public function getClient($slug){
        $client = Client::where('slug', $slug)->first();
        if(!empty($client)){
            return view('policy::clients.view', ['client'=>$client]);
        }else{
            return back();
        }
    }

    public function viewPolicy($slug){
        $policy = Policy::where('slug', $slug)->first();
        if(!empty($policy)){
            return view('policy::view-policy', ['policy'=>$policy]);
        }else{
            session()->flash("error", "<strong>Ooops!</strong> Record not found.");
            return back();
        }
    }
    public function getSubClasses(Request $request)
    {
        $subs = SubBusinessClass::where('business_class_id', $request->id)->get();
        return view('policy::common.subs', ['subs'=>$subs]);
    }
    public function policySettings()
    {
        $agents = Agent::orderBy('agent_name', 'ASC')->get();
        $classes = BusinessClass::orderBy('class_name', 'ASC')->get();
        $subs = SubBusinessClass::orderBy('class_name', 'ASC')->get();
        return view('policy::constants', ['agents'=>$agents, 'classes'=>$classes, 'subs'=>$subs]);
    }
    public function createAgent(Request $request)
    {
        try {
                $request->validate([
                'agent_name'=>'required'
                ]);
            }catch (ValidationException $exception) {
                return response()->json([
                    'status' => 'error',
                    'msg'    => 'Agent name is required.',
                    'errors' => $exception->errors(),
                ], 422);
        }
        $agent = new Agent;
        $agent->agent_name = $request->agent_name;
        $agent->save();
        if($agent){
            return response()->json(['message'=>'Success! New agent registered.'], 200);
        }else{
            return response()->json(['error'=>'Whoops! Could not register agent. Try again.'], 400);
        }
    }

    public function editAgent(Request $request)
    {
        $agent = Agent::find($request->id);
        if(!empty($agent)){
            $agent->agent_name = $request->agent_name;
            $agent->save();
        if($agent){
            return response()->json(['message'=>'Success! Changes saved.'], 200);
            }else{
                return response()->json(['error'=>'Ooops! Could not save changes. Try again.'], 400);
            }
        }else{
            return response()->json(['error'=>'Whoops! No such record found.'], 400);
        }
    }

    public function createBusinessClass(Request $request)
    {
        try {
                $request->validate([
                'business_class_name'=>'required'
                ]);
            }catch (ValidationException $exception) {
                return response()->json([
                    'status' => 'error',
                    'msg'    => 'Business class name is required.',
                    'errors' => $exception->errors(),
                ], 422);
        }
        $business = new BusinessClass;
        $business->class_name = $request->business_class_name;
        $business->abbr = strtoupper(substr($request->business_class_name, 0,3));
        $business->save();
        if($business){
            return response()->json(['message'=>'Success! New business class registered.'], 200);
        }else{
            return response()->json(['error'=>'Whoops! Could not register business class. Try again.'], 400);
        }
    }

    public function editBusinessClass(Request $request)
    {
        try {
                $request->validate([
                'business_class_name'=>'required'
                ]);
            }catch (ValidationException $exception) {
                return response()->json([
                    'status' => 'error',
                    'msg'    => 'Business class name is required.',
                    'errors' => $exception->errors(),
                ], 422);
        }
        $business = BusinessClass::find($request->id);
        $business->class_name = $request->business_class_name;
        $business->abbr = strtoupper(substr($request->business_class_name, 0,3));
        $business->save();
        if($business){
            return response()->json(['message'=>'Success! Changes saved.'], 200);
        }else{
            return response()->json(['error'=>'Whoops! Could not save changes. Try again.'], 400);
        }
    }
    public function createSubBusinessClass(Request $request)
    {
        try {
                $request->validate([
                'sub_business_class_name'=>'required',
                'class'=>'required'
                ]);
            }catch (ValidationException $exception) {
                return response()->json([
                    'status' => 'error',
                    'msg'    => 'All fields are required.',
                    'errors' => $exception->errors(),
                ], 422);
        }
        $business = new SubBusinessClass;
        $business->class_name = $request->sub_business_class_name;
        $business->business_class_id = $request->class;
        $business->save();
        if($business){
            return response()->json(['message'=>'Success! New sub-business class registered.'], 200);
        }else{
            return response()->json(['error'=>'Whoops! Could not register sub-business class. Try again.'], 400);
        }
    }
    public function editSubBusinessClass(Request $request)
    {
        try {
                $request->validate([
                'sub_business_class_name'=>'required',
                'class'=>'required'
                ]);
            }catch (ValidationException $exception) {
                return response()->json([
                    'status' => 'error',
                    'msg'    => 'All fields are required.',
                    'errors' => $exception->errors(),
                ], 422);
        }
        $business = SubBusinessClass::find($request->id);;
        $business->class_name = $request->sub_business_class_name;
        $business->business_class_id = $request->class;
        $business->save();
        if($business){
            return response()->json(['message'=>'Success! Changes saved.'], 200);
        }else{
            return response()->json(['error'=>'Ooops! Could not save changes. Try again.'], 400);
        }
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
