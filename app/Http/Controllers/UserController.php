<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function viewLoginForm()
    {
        return view('login.index');
    }

    public function processLogin(Request $request)
    {
        if(Auth::attempt(['email' => $request->username, 'password' => $request->password]))
        {
            return Auth::user();
        }
        else
        {
            return -1;
        }
    }

    public function doLogout()
    {
        Auth::logout();
        return redirect('login');
    }

    public function loadUsersList($user_type)
    {
        $data['user_type'] = $user_type;
        return view('admin.users_list', $data);
    }

    public function getUsersList($user_type)
    {
        if($user_type == 'clients')
        {
            $data['users'] = User::where('role', 2)->get();
        }
        elseif ($user_type == 'employees')
        {
            $data['users'] = User::where('role', 3)->get();
        }

        return $data;

    }

    public function registerUser(Request $request)
    {
        $count = User::where('email', $request->email_address)->count();
        if($count > 0)
            return -1; // Email address already exists
        else
        {
            $user = new User();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->company = $request->company;
            $user->account_type = $request->account_type;
            $user->email = $request->email_address;
            $user->password = Hash::make($request->password);
            if($request->user_type == 'clients')
                $user->role = 2;
            elseif($request->user_type == 'employees')
                $user->role = 3;
            $user->save();

            $user->roles()->attach($request->role_id);
        }
    }

    public function viewRoles()
    {
        return view('admin.roles');
    }

    public function viewPermissions()
    {
        return view('admin.permissions');
    }

    public function getRoles()
    {
        $data['roles'] = Role::get();
        return $data;
    }

    public function addRoles(Request $request)
    {
        $role = new Role();
        $role->name = $request->name;
        $role->name = $request->name;
        $role->save();
    }

    public function getPermissions()
    {
        $data['permissions'] = Permission::get();
        return $data;
    }

    public function addPermissions(Request $request)
    {
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->display_name = $request->display_name;
        $permission->description = $request->description;
        $permission->save();
    }

    public function assignPermission($role_id)
    {
        $data['role_id'] = $role_id;
        $data['role'] = Role::where('id', $role_id)->get();
        return view('admin.assign_permissions', $data);
    }

    public function assignPermissionToRole(Request $request)
    {
        return $request->all();
    }
}
