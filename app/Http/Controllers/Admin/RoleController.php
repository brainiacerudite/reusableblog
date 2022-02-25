<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Role::class, 'roles');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pageTitle'] = 'Browse Roles';
        $data['datas'] = Role::all();
        $data['rType'] = 'role';
        return view('admin.roles.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['pageTitle'] = 'Create Role';
        $data['formType'] = 'add';
        $data['rType'] = 'role';
        // $data['permissions'] = Permission::all();
        $data['permissions'] = Permission::all()->groupBy(function ($item, $key) {
            $arr = explode(' ', trim($item->name));
            return $arr[1];
        });
        return view('admin.roles.edit', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:40|unique:roles,name',
            // 'permissions' => 'required'
        ]);
        $name = $request->name;
        $role = new Role;
        $role->name = $name;
        $permissions = $request->permissions;
        $role->save();
        //Looping thru selected permissions
        if (!empty($permissions)) {
            foreach ($permissions as $permission) {
                $p = Permission::where('id', '=', $permission)->firstOrFail();
                //Fetch the newly created role and assign permission
                $role = Role::where('name', '=', $name)->first();
                $role->givePermissionTo($p);
            }
        }
        return redirect(route('admin.roles.index'))->with('success', 'Role' . $role->name . ' added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return redirect(route('admin.roles.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        if ($role->name == 'superadmin' || $role->name == 'normaluser') {
            return redirect(route('admin.roles.index'))->with('warning', 'Access Denied!');
        }
        $data['pageTitle'] = 'Edit Role';
        $data['formType'] = 'edit';
        $data['rType'] = 'role';
        $data['data'] = $role;
        // $data['permissions'] = Permission::all();
        $data['permissions'] = Permission::all()->groupBy(function ($item, $key) {
            $arr = explode(' ', trim($item->name));
            return $arr[1];
        });
        return view('admin.roles.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => 'required|max:10|unique:roles,name,' . $role->id,
            // 'permissions' => 'required',
        ]);
        if ($request->name == 'normaluser') {
            return back();
        }
        $input = $request->except(['permissions']);
        $permissions = $request->permissions;
        $role->fill($input)->save();

        $p_all = Permission::all(); //Get all permissions

        foreach ($p_all as $p) {
            $role->revokePermissionTo($p); //Remove all permissions associated with role
        }
        if (!empty($permissions)) {
            foreach ($permissions as $permission) {
                $p = Permission::where('id', '=', $permission)->firstOrFail(); //Get corresponding form //permission in db
                $role->givePermissionTo($p);  //Assign permission to role
            }
        }
        return redirect(route('admin.roles.index'))->with('success', 'Role' . $role->name . ' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if ($role->name == 'superadmin' || $role->name == 'normaluser') {
            return redirect(route('admin.roles.index'))->with('warning', 'Access Denied!');
        }
        $role->delete();
        return redirect(route('admin.roles.index'))->with('success', 'Role deleted!');
    }
}
