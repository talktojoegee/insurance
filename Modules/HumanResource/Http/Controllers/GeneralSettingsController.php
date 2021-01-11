<?php

namespace Modules\HumanResource\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Modules\HumanResource\Entities\Department;
use Modules\HumanResource\Entities\JobRole;
use Modules\HumanResource\Entities\EmploymentType;
use Modules\HumanResource\Entities\AcademicQualification;
use Auth;
class GeneralSettingsController extends Controller
{

    public function __construct(){
        //$this->middleware('auth');
    }

        public function settings()
    {
        $departments = Department::orderBy('name', 'ASC')->get();
        $roles = JobRole::orderBy('job_role', 'ASC')->get();
        $emp_types = EmploymentType::orderBy('name', 'ASC')->get();
        $qualifications = AcademicQualification::orderBy('name', 'ASC')->get();
        return view('humanresource::settings',
        [
            'departments'=>$departments,
            'roles'=>$roles,
            'emp_types'=>$emp_types,
            'qualifications'=>$qualifications
        ]);
    }

    public function addNewDepartment(Request $request){
        $request->validate([
            'name'=>'required'
        ]);
        $department = new Department;
        $department->name = $request->name;
        $department->added_by = 2;
        $department->save();
        if($department){
            return response()->json(['message'=>'Success! New department registered'], 200);
        }else{
            return response()->json(['error'=>'Ooops! Could not register new department. Try again.'], 400);
        }
    }   
     public function addNewJobRole(Request $request){
        $request->validate([
            'department'=>'required',
            'role'=>'required',
            'description'=>'required'
        ]);
        $role = new JobRole;
        $role->department_id = $request->department;
        $role->job_role = $request->role;
        $role->description = $request->description;
        $role->added_by = 2;
        $role->save();
        if($role){
            return response()->json(['message'=>'Success! New role registered'], 200);
        }else{
            return response()->json(['error'=>'Ooops! Could not register new role. Try again.'], 400);
        }
    }     
    public function addNewEmploymentType(Request $request){
        $request->validate([
            'name'=>'required'
        ]);
        $type = new EmploymentType;
        $type->name = $request->name;
        $type->added_by = 2;
        $type->save();
        if($type){
            return response()->json(['message'=>'Success! New role registered'], 200);
        }else{
            return response()->json(['error'=>'Ooops! Could not register new role. Try again.'], 400);
        }
    }    
    public function addNewAcademicQualification(Request $request){
        $request->validate([
            'name'=>'required'
        ]);
        $qualification = new AcademicQualification;
        $qualification->name = $request->name;
        $qualification->added_by = 2;
        $qualification->save();
        if($qualification){
            return response()->json(['message'=>'Success! New qualification registered'], 200);
        }else{
            return response()->json(['error'=>'Ooops! Could not register new qualification. Try again.'], 400);
        }
    }

    public function applicationRole(Request $request)
    {
        $request->validate([
            'role_name'=>'required|unique:roles,name'
        ]);
        Role::create(['name'=>$request->role_name]);
        return response()->json(['message'=>'Success! New role registered.'], 200);
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
