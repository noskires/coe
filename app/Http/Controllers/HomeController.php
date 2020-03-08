<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Role::create(['id'=>1, 'name'=>'writer', 'guard_name'=>'web']);
        // $role = Role::create(['name' => 'writer']);
        // $permission = Permission::create(['name' => 'edit articles']);

        // $role = Role::findById(2);
        // $permission = Permission::findById(2);

        // $role->givePermissionTo($permission);
        // $permission->assignRole($role);


        // create role
        // Role::create(['name'=>'ticketer']);
        // Role::create(['name'=>'fulfiller']);
        // Role::create(['name'=>'admin']);

        // create permission
        // Permission::create(['name'=>'create ticket']);
        // Permission::create(['name'=>'edit ticket']);
        // Permission::create(['name'=>'delete ticket']);

        // givePermission
        // $role = Role::findById(5);
        // $permission = Permission::findById(5);
        // $role->givePermissionTo($permission);

        // give permission to users
        // auth()->user()->givePermissionTo($permission);
        // $user = User::where('id', 3)->first();
        // $permission = Permission::findById(3);
        // $user->givePermissionTo($permission);

        // give role to users
        // auth()->user()->givePermissionTo($permission);
        // $user = User::where('id', 3)->first();
        // $role = Role::findById(5);
        // $user->assignRole($role);

        // return auth()->user()->permissions;

        // revode permission
        // $user = User::where('id', 3)->first();
        // $permission = Permission::findById(3);
        // $user->revokePermissionTo($permission);
        return view('home');
    }
}
