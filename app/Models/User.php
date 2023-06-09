<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname', 'lastname', 'middlename', 'email', 'password', 'role_id',
        'uuid', 'is_active', 'reset_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin(): bool {
        if ($this->role_id === config('global.Roles')['adminRole']) return true;

        else return false;
    }

    public function hasRole($roleName): bool {
        $name = Str::ucfirst($roleName);
        $role = Role::where('name', '=', $name)->first();

        if ($role && $this->role_id === $role->id) return true;
        else return false;
    }

    /**
     * A user has one role
     */
    public function role(): HasOne {
        return $this->hasOne(Role::class);
    }
}
