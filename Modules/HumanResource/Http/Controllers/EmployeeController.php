<?php

namespace Modules\HumanResource\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\HumanResource\Emails\NewEmployeeMail;
use Modules\HumanResource\Entities\BloodGroup;
use Modules\HumanResource\Entities\Department;
use Modules\HumanResource\Entities\Genotype;
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
        $this->bloodgroup = new BloodGroup();
        $this->genotype = new Genotype();
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
            'access'=>$access,
            'states'=>$this->state->getStates(),
            'blood_groups'=>$this->bloodgroup->getBloodGroups()
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
            'employee_id'=>'required',
            'academic_qualification'=>'required',
            'employment_type'=>'required',
            'hire_date'=>'required|date',
            'application_access_level'=>'required',
            'application_access_level'=>'required',
        ],[
            'first_name.required'=>"Enter first name",
            'last_name.required'=>"Enter last name",
            'email_address.required'=>"Enter a valid email address",
            'mobile_no.required'=>"Mobile number is required",
            'gender.required'=>"What's the gender?",
            'marital_status.required'=>"Choose the marital status that best defines the employee",
            'state_of_origin.required'=>"This person is of what state origin? Choose from the options provided.",
            'lga.required'=>"Help us with the associated Local Government Area",
            'residential_address.required'=>"Where does this person reside?",
            'department.required'=>"It's fitting to assign this employee to a department",
            'job_role.required'=>"What's the employee's job role?",
            'employee_id.required'=>"Let's have the employee ID",
            'academic_qualification.required'=>"Select academic qualification",
            'employment_type.required'=>"Choose employment type",
            'hire_date.required'=>"When was this employee hired?",
            'hire_date.date'=>"Enter a valid date format",
            'application_access_level.required'=>"Grant access level",
        ]);
        try{
            $password = strtoupper(substr(sha1(time()), 32,40));
            $user = $this->user->addEmployee($request, $password);
            \Mail::to($user)->send(new NewEmployeeMail($user, $password));
            session()->flash("success", "<strong>Success!</strong> Action successful. Login credentials were sent via registered email.");
            return redirect('/human-resource');
        }catch (\Exception $exception){
            return dd($exception);
        }


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

    public function updateEmployeeAccountStatus(Request $request){
        $request->validate([
            'status'=>'required',
            'employeeId'=>'required'
        ]);
        $this->user->updateAccountStatus($request);
        session()->flash("success", "Account status updated.");
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
