<?php

namespace Modules\HumanResource\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\HumanResource\Emails\NewEmployeeMail;
use Modules\HumanResource\Entities\Department;
use Modules\HumanResource\Entities\JobRole;
use Modules\HumanResource\Entities\MaritalStatus;
use Modules\HumanResource\Entities\EmploymentType;
use Modules\HumanResource\Entities\AcademicQualification;
use Spatie\Permission\Models\Role;

use App\Models\User;
use Auth;

class EmployeeController extends Controller
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
        $employees = User::where('account_status',1)->where('visibility', 1)->orderBy('first_name', 'ASC')->get();
        return view('humanresource::index',['employees'=>$employees]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function addNewEmployee()
    {
        config(['app.timezone' => 'Africa/Lagos']);

        $departments = Department::orderBy('name', 'ASC')->get();
        $roles = JobRole::orderBy('job_role', 'ASC')->get();
        $emp_types = EmploymentType::orderBy('name', 'ASC')->get();
        $qualifications = AcademicQualification::orderBy('name', 'ASC')->get();
        $marital_status = MaritalStatus::orderBy('name', 'ASC')->get();
        $access = Role::orderBy('name', 'ASC')->get();
        return view('humanresource::add-new-employee',[
            'roles'=>$roles,
            'emp_types'=>$emp_types,
            'qualifications'=>$qualifications,
            'departments'=>$departments,
            'marital_status'=>$marital_status,
            'access'=>$access
        ]);
    }

    public function onboardNewEmployee(Request $request)
    {
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email_address'=>'required|email|unique:users,email',
            'mobile_no'=>'required',
            'gender'=>'required',
            'marital_status'=>'required',
            'state_of_origin'=>'required',
            'lga'=>'required',
            'residential_address'=>'required',
            'department'=>'required',
            'job_role'=>'required',
            'employee_id'=>'required'
        ]);
        $password = strtoupper(substr(sha1(time()), 32,40));
        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->other_names = $request->other_names;
        $user->email = $request->email_address;
        //$user->official_email = $request->official_email;
        $user->mobile_no = $request->mobile_no;
        $user->gender = $request->gender;
        $user->marital_status = $request->marital_status;
        $user->state = $request->state_of_origin;
        $user->lga = $request->lga;
        $user->address = $request->residential_address;
        $user->birth_date = $request->birth_date;
        $user->known_ailment = $request->known_ailment;
        $user->blood_group = $request->blood_group;
        $user->genotype = $request->genotype;
        $user->department = $request->department;
        $user->job_role = $request->job_role;
        $user->url = substr(sha1(time()), 11,40);
        //$user->grade = $request->grade;
        $user->academic_qualification = $request->academic_qualification;
        $user->employee_id = $request->employee_id;
        $user->employment_type = $request->employment_type;
        $user->hire_date = $request->hire_date;
        $user->role = $request->application_access_level;
        $user->password = bcrypt($password);
        $user->save();
        \Mail::to($user)->send(new NewEmployeeMail($user, $password));
        session()->flash("success", "<strong>Success!</strong> New employee registered. Login credentials sent via mail.");

        return redirect('/human-resource');

    }

    public function profile($url){
        $employee = User::where('visibility',1)->where('url', $url)->first();
        if(!empty($employee)){
        return view('humanresource::profile', ['employee'=>$employee]);
        }else{
            session()->flash("error", "<strong>Ooops!</strong> No record found.");
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
        return view('humanresource::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('humanresource::edit');
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
