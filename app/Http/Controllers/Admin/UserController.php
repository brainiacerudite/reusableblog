<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAnyUser', User::class);

        $data['pageTitle'] = 'Browse Users';
        // $data['datas'] = User::whereDoesntHave('roles')->orderBy('created_at', 'desc')->get();
        $userWithNoRoles = User::whereDoesntHave('roles')->get();
        $userWithRoles = User::role('normaluser')->get();
        $merged = $userWithNoRoles->merge($userWithRoles);
        $data['datas'] = $merged->sortByDesc('created_at')->all();
        $data['rType'] = 'user';
        return view('admin.administrators.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('createUser', User::class);

        $data['pageTitle'] = 'Create User';
        $data['formType'] = 'add';
        $data['rType'] = 'user';
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
        $this->authorize('createUser', User::class);

        $validated = $request->validate([
            'name' => 'required|max:120',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);

        $request['password'] = Hash::make($request->password);
        $user = User::create($request->only('email', 'name', 'password'));
        return redirect(route('admin.users.index'))->with('success', 'User successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('viewUser', User::class);

        return redirect(route('admin.users.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('updateUser', User::class);

        $data['data'] = User::findOrFail($id);
        if (in_array('superadmin', $data['data']->roles()->pluck('name')->toArray())) {
            return redirect(route('admin.administrators.index'))->with('warning', 'Access Denied!');
        }
        $data['pageTitle'] = 'Edit User';
        $data['formType'] = 'edit';
        $data['rType'] = 'user';
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
        $this->authorize('updateUser', User::class);

        $user = User::findOrFail($id);

        if (!empty($request->password) || !empty($request->password_confirmation)) {
            $validated = $request->validate([
                'name' => 'required|max:120',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'required|min:8|confirmed'
            ]);

            $request['password'] = Hash::make($request->password);
            $input = $request->only('email', 'name', 'password');
        } else {
            $validated = $request->validate([
                'name' => 'required|max:120',
                'email' => 'required|email|unique:users,email,' . $id,
            ]);

            $input = $request->only('email', 'name');
        }

        $user->fill($input)->save();
        return redirect(route('admin.users.index'))->with('success', 'User successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('deleteUser', User::class);

        $user = User::findOrFail($id);
        // dd(in_array('superadmin', $user->roles()->pluck('name')->toArray()));
        if (in_array('superadmin', $user->roles()->pluck('name')->toArray())) {
            return redirect(route('admin.users.index'))->with('warning', 'Access Denied!');
        }
        $user->delete();
        return redirect(route('admin.users.index'))->with('success', 'Deleted Successfully');
    }
}
