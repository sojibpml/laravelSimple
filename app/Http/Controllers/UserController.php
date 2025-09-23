<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{

    // public function roles()
    // {
    //     // $user = User::find(2);
    //     // $user->roles()->sync([2]);
    //     // // attach, detach, sync
    //     // $users = User::with("roles")->get();
    //     // return $users;



    //     // $user = User::find(2);
    //     // $user->roles()->sync([1, 2]);
    //     // $users = User::with('permissions')->get();
    //     // return $users;

    //     $user = User::find(2);
    //     $user->permissions()->attach([1, 2]);
    //     $users = User::with('permissions')->get();
    //     return $users;



    //     // $user = User::find(2);
    //     // $user->permissions()->sync([1, 2]);
    //     // $users = User::with('permissions')->get();
    //     // return $users;
    //     // return view('roles',compact('users'));
    // }
    // public function delete($id)
    // {
    //     $user = User::findOrFail($id);
    //     $user->delete();
    //     // return redirect()->with()
    // }


    public function index()
    {
        $users = User::with('roles')->get();
        return view('users.index', compact('users'));
    }
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'roles' => 'required|array'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->roles()->attach($request->roles);
        return redirect()->route('users.index')->with('success', 'User Created');
    }


    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'roles' => 'required|array'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        $user->roles()->sync($request->roles);

        return redirect()->route('users.index')->with('success', 'User Updated');
    }

    public function destroy(User $user)
    {
        if (!Auth::user()->hasRole('admin')) {
            return redirect()->route('users.index')->with('error', 'Only admin can delete users.');
        }
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User Deleted');
    }
}
