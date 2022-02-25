<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Permission::class, 'permissions');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pageTitle'] = 'Browse Permissions';
        $data['datas'] = Permission::all();
        $data['rType'] = 'permission';
        return view('admin.roles.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['pageTitle'] = 'Create Permission';
        $data['formType'] = 'add';
        $data['rType'] = 'permission';
        $data['roles'] = Role::get();
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
            'name' => 'required|max:40'
        ]);

        $name = $request->name;
        $permission = new Permission;
        $permission->name = $name;
        $roles = $request->roles;
        $permission->save();
        if (!empty($request->roles)) {
            foreach ($roles as $role) {
                $r = Role::where('id', '=', $role)->firstOrFail(); //Match input role to db record

                $permission = Permission::where('name', '=', $name)->first(); //Match input //permission to db record
                $r->givePermissionTo($permission);
            }
        }
        return redirect(route('admin.permissions.index'))->with('success', 'Permission' . $permission->name . ' added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        return redirect(route('admin.permissions.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        $data['pageTitle'] = 'Edit Administrator';
        $data['formType'] = 'edit';
        $data['rType'] = 'permission';
        $data['data'] = $permission;
        return view('admin.roles.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate([
            'name' => 'required|max:40'
        ]);

        $input = $request->all();
        $permission->fill($input)->save();
        return redirect(route('admin.permissions.index'))->with('success', 'Permission' . $permission->name . ' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        //Make it impossible to delete this specific permission
        if ($permission->name == "browse admin") {
            return redirect()->route('admin.permissions.index')->with('warning', 'Cannot delete this Permission!');
        }

        $permission->delete();

        return redirect(route('admin.permissions.index'))->with('success', 'Permission deleted!');
    }
}
