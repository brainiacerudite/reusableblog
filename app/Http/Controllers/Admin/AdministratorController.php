<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdministratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);

        $data['pageTitle'] = 'Browse Administrators';
        $data['datas'] = User::whereHas('roles')->orderBy('created_at', 'desc')->get();
        $data['rType'] = 'admin';
        return view('admin.administrators.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', User::class);

        $data['pageTitle'] = 'Create Administrator';
        $data['formType'] = 'add';
        $data['rType'] = 'admin';
        $data['roles'] = Role::orderBy('id', 'desc')->get();
        return view('admin.administrators.edit', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $validated = $request->validate([
            'name' => 'required|max:120',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);

        $request['password'] = Hash::make($request->password);
        $user = User::create($request->only('email', 'name', 'password'));
        $roles = $request->roles;
        if (isset($roles)) {
            foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();
                $user->assignRole($role_r);
            }
        }

        return redirect(route('admin.administrators.index'))->with('success', 'Administrators successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view', User::class);

        return redirect(route('admin.administrators.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update', User::class);

        $data['data'] = User::findOrFail($id);
        if (in_array('superadmin', $data['data']->roles()->pluck('name')->toArray())) {
            return redirect(route('admin.administrators.index'))->with('warning', 'Access Denied!');
        }
        $data['pageTitle'] = 'Edit Administrator';
        $data['formType'] = 'edit';
        $data['rType'] = 'admin';
        $data['roles'] = Role::orderBy('id', 'desc')->get();
        return view('admin.administrators.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update', User::class);

        $validated = $request->validate([
            'name' => 'required|max:120',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'required|min:8|confirmed'
        ]);

        $request['password'] = Hash::make($request->password);
        $input = $request->only('email', 'name', 'password');
        $roles = $request->roles;
        $user = User::findOrFail($id);
        $user->fill($input)->save();
        if (isset($roles)) {
            $user->roles()->sync($roles);  //If one or more role is selected associate user to roles
        } else {
            $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
        }

        return redirect(route('admin.administrators.index'))->with('success', 'Administrators successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', User::class);

        $user = User::findOrFail($id);
        // dd(in_array('superadmin', $user->roles()->pluck('name')->toArray()));
        if (in_array('superadmin', $user->roles()->pluck('name')->toArray())) {
            return redirect(route('admin.administrators.index'))->with('warning', 'Access Denied!');
        }
        $user->delete();
        return redirect(route('admin.administrators.index'))->with('success', 'Deleted Successfully');
    }
}
