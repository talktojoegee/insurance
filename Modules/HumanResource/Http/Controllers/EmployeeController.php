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
use Modules\Policy\Entities\State;
use Spatie\Permission\Models\Role;

use App\Models\User;
use Auth;

class EmployeeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->user = new User();
        $this->department = new Department();
        $this->jobrole = new JobRole();
        $this->state = new State();
        $this->qualification = new AcademicQualification();
        $this->employementtype = new EmploymentType();
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $employees = $this->user->getAllEmployees();
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
    public function settings($url){
        $employee = $this->user->getEmployeeBySlug($url);
        if(!empty($employee)){
        return view('humanresource::employee-settings',
            [
                'employee'=>$employee,
                'departments'=>$this->department->getDepartments(),
                'jobRoles'=>$this->jobrole->getJobRoles(),
                'states'=>$this->state->getStates(),
                'qualifications'=>$this->qualification->getAcademicQualifications(),
                'employement_types'=>$this->employementtype->getEmploymentTypes()
                ]);
        }else{
            session()->flash("error", "<strong>Whoops!</strong> No record found.");
            return back();
        }
    }

    public function editEmployeeProfile(Request $request){
        $request->validate([
            'firstName'=>'required',
            'lastName'=>'required',
            'state'=>'required',
            'department'=>'required',
            'mobileNo'=>'required',
            'qualification'=>'required',
            'employmentType'=>'required',
            'employeeId'=>'required',
            'jobRole'=>'required',
            'address'=>'required',
            'gender'=>'required',
            'empId'=>'required'
        ],[
            'firstName.required'=>'Enter employee first name',
            'lastName.required'=>'Enter employee surname',
            'state.required'=>'Select state of origin from the list provided.',
            'department.required'=>"Choose department for this employee",
            'mobileNo.required'=>'Enter mobile number',
            'qualification.required'=>"What's employee's highest qualification?",
            'employmentType.required'=>'Choose mode of employment',
            'employeeId.required'=>'Enter employee ID',
            'jobRole.required'=>'Choose a job role',
            'address.required'=>'Enter residential address',
            'gender.required'=>'Choose gender'
        ]);
        $this->user->updateEmployeeProfile($request);
        session()->flash("success", "Employee profile updated!");
        return back();
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
