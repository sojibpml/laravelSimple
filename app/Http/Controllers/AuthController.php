<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class AuthController extends Controller
{



    public $user;

    public function __construct()
    {
        $this->user = User::first();
    }
    //  new work
    public function assignAdminRole()
    {

        $user = User::first();
        $role = Role::where('name', 'admin')->first();

        if ($user && $role) {
            $user->roles()->attach($role->id);
            return "Admin role assigned to user: " . $user->name;
        }

        return "User or Role not found";
    }

    public function showAdmin()
    {

        if (!$this->user->checkRole(["admin", "manager"])) {
            return abort(401, "Unauthorize");
        }

        return User::all();
    }
    // new work


}