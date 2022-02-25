<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Page;
use App\Models\Post;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $data['pageTitle'] = 'Admin Panel';
        $data['countPost'] = Post::count();
        $userWithNoRoles = User::whereDoesntHave('roles')->get();
        $userWithRoles = User::role('normaluser')->get();
        $merged = $userWithNoRoles->merge($userWithRoles);
        $data['countComment'] = Comment::count();
        $data['countPage'] = Page::count();
        $data['countUser'] = $merged->count();
        return view('admin.dashboard', $data);
    }

    public function index()
    {
        $data['pageTitle'] = 'Manage Settings';
        return view('admin.settings.index', $data);
    }

    public function update(Request $request)
    {
        $this->authorize('update', Settings::class);

        if ($request->stype === 'site') {
            $validated = $request->validate([
                'site_name' => 'required|string',
                'site_logo' => 'image|mimes:jpeg,jpg,png|max:2048',
                'site_favicon' => 'image|mimes:png|max:1024',
                'default_email_address' => 'required|string|email',
                'footer_copyright_text' => 'required|string',
                'base_color' => 'required',
                'secondary_color' => 'required',
            ]);
        }

        if ($request->has('site_logo')) {
            if (config('settings.site_logo') != null && config('settings.site_logo') != 'default-logo.png') {
                deleteFile(public_path(config('settings.site_logo')));
            }
            if (!empty($request->resize_logo)) {
                $logo = uploadOne($request->file('site_logo'), 'site', 'site_logo', $request->resize_logo);
            } else {
                $logo = uploadOne($request->file('site_logo'), 'site', 'site_logo');
            }

            Settings::set('site_logo', $logo);
        }
        if ($request->has('site_favicon')) {
            if (config('settings.site_favicon') != null && config('settings.site_favicon') != 'default-favicon.png') {
                deleteFile(public_path(config('settings.site_favicon')));
            }
            if (!empty($request->resize_icon)) {
                $favicon = uploadOne($request->file('site_favicon'), 'site', 'site_favicon', $request->resize_icon);
            } else {
                $favicon = uploadOne($request->file('site_favicon'), 'site', 'site_favicon');
            }

            Settings::set('site_favicon', $favicon);
        }

        $keys = $request->except('_token', 'site_logo', 'site_favicon', 'stype', 'resize_logo', 'resize_icon');
        foreach ($keys as $key => $value) {
            Settings::set($key, $value);
        }

        return back()->with('success', 'Settings updated successfully.');
    }

    public function profile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->save();

        return back()->with('success', 'Profile updated successfully.');
    }

    public function change(Request $request)
    {
        $validatedData = $request->validate([
            'current_password' => 'required|min:8',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|same:password',
        ], [
            'current_password.required' => 'Old password is required',
            'current_password.min' => 'Old password needs to have at least 8 characters',
            'password.required' => 'Password is required',
            'password.min' => 'Password needs to have at least 8 characters',
            'password_confirmation.required' => 'Passwords do not match'
        ]);

        $currUser = Auth::user();

        $current_password = $currUser->password;
        if (!(Hash::check($request->input('current_password'), $current_password))) {
            return back()->withErrors('Please enter correct current password.');
        }

        $user_id = $currUser->id;
        $obj_user = User::find($user_id);
        $obj_user->password = Hash::make($request->input('password'));
        $obj_user->save();

        return back()->with('success', 'Password updated successfully.');
    }
}
