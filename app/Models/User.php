<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // public function roles()
    // {
    //     // return $this->hasOneThrough(
    //     //     Role::class,       
    //     //     UsersRole::class,   
    //     //     'user_id',         
    //     //     'id',               
    //     //     'id',              
    //     //     'role_id'           // Local key on pivot pointing to roles
    //     // );

    //     return $this->belongsToMany(Role::class, 'users_roles', 'user_id', 'role_id', 'id', 'id');
    // }
    // public function permissions()
    // {
    //     return $this->belongsToMany(Permission::class, 'users_permissions', 'user_id', 'permission_id', 'id', 'id');
    // }

    // new
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function hasRole($roleName)
    {
        return $this->roles->contains('name', $roleName);
    }
    public function isAdmin()
    {
        return $this->hasRole('admin');
    }
    public function isSuperAdmin()
    {
        return $this->hasRole('super Admin');
    }

    public function checkRole(string|array $roles)
    {
        $role = collect($this->roles)->whereIn("name", (array) $roles)->first();

        if ($role)
            return true;

        return false;
    }
    // 
    public function checkRoleOne(string|array $roles)
    {
        $role = collect($this->roles)->whereIn('name', (array) $roles)->first();
        if ($role) {
            return true;
        }
        return false;
    }
}
