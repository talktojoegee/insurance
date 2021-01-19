<?php

namespace Modules\HumanResource\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;
class ManageRolesAndPermissionsController extends Controller
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
        $roles = Role::orderBy('name', 'ASC')->get();
        $permissions = Permission::orderBy('name', 'ASC')->get();
        return view('humanresource::manage-roles-and-permissions',['roles'=>$roles, 'permissions'=>$permissions]);
    }

    public function showAssignPermissionToRole($id){
        $role = Role::find($id);
        if(!empty($role)){
            $permissions = Permission::orderBy('name', 'ASC')->get();
            return view('humanresource::assign-permission', ['role'=>$role, 'permissions'=>$permissions]);
        }else{
            return back();
        }
    }

    public function assignPermissionToRole(Request $request){
        $role = Role::find($request->role);
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
