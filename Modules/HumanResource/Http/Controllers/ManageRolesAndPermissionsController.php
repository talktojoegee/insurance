<?php

namespace Modules\HumanResource\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Permission as SPermission;
use Auth;
use Spatie\Permission\Models\Role as SRole;

class ManageRolesAndPermissionsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->permission = new Permission();
        $this->role = new Role();
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $roles = SRole::orderBy('name', 'ASC')->get();
        $permissions = SPermission::orderBy('name', 'ASC')->get();
        return view('humanresource::manage-roles-and-permissions',['roles'=>$roles, 'permissions'=>$permissions]);
    }

    public function showManageRoles()
    {
        $roles = $this->role->getRoles();
        $permissions = $this->permission->getPermissions();// SPermission::orderBy('name', 'ASC')->get();
        return view('humanresource::manage-roles',['roles'=>$roles, 'permissions'=>$permissions]);
    }

    public function editPermission(Request $request){
        $request->validate([
            'permissionName'=>'required',
            //'module'=>'required',
            'permissionId'=>'required',
        ],[
            'permissionName.required'=>'Enter permission name',
            //'module.required'=>'Choose the associate module',
        ]);
        $this->permission->editPermission($request);
        session()->flash("success", "Your changes were saved.");
        return back();
    }

    public function updateRolePermissions(Request $request){
        $request->validate([
            'roleId'=>'required'
        ]);
        $role = SRole::findById($request->roleId);
        if(!empty($role)){
            $permissionIds = [];
            foreach($request->permission as $permit){
                array_push($permissionIds, $permit);
            }
            $permissions = $this->permission->getPermissionsByIds($permissionIds);
            $role->syncPermissions($permissions);
            session()->flash("success", "Action successful.");
            return back();
        }else{
            session()->flash("error", "Something went wrong. Try again later");
            return back();
        }
    }

    public function showAssignPermissionToRole($id){
        $role = SRole::find($id);
        if(!empty($role)){
            $permissions = Permission::orderBy('name', 'ASC')->get();
            return view('humanresource::assign-permission', ['role'=>$role, 'permissions'=>$permissions]);
        }else{
            return back();
        }
    }

    public function assignPermissionToRole(Request $request){
        $role = SRole::find($request->role);
        $role->syncPermissions($request->permission);
        session()->flash("success", "<strong>Success!</strong> Permissions assigned to role.");
        return back();
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('humanresource::create');
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
