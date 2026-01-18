<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'photo',
        'role',
        'permissions',
        'status',
        'last_login_at',
        'login_attempts',
        'notes',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'permissions' => 'array',
    ];

    /**
     * Get the admin's full display name.
     */
    public function getDisplayNameAttribute()
    {
        return $this->name;
    }

    /**
     * Check if admin has a specific role.
     */
    public function hasRole($role): bool
    {
        return $this->role === $role;
    }

    /**
     * Check if admin has a specific permission.
     */
    public function hasPermission($permission): bool
    {
        if (!is_array($this->permissions)) {
            return false;
        }
        return in_array($permission, $this->permissions);
    }

    /**
     * Scope to get active admins only.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope to get admins by role.
     */
    public function scopeByRole($query, $role)
    {
        return $query->where('role', $role);
    }
}
