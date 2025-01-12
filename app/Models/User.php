<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser, \Filament\Models\Contracts\HasName
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'fullname',
        'email', 
        'password',
        'image',
        'role_id',
        'google_id',
        'google_token',
        'google_refresh_token'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function ($user) {
            if (!$user->role_id) {
                $userRole = Role::where('name', 'user')->first();
                if ($userRole) {
                    $user->role_id = $userRole->id;
                }
            }
        });
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasRole($roleName)
    {
        return $this->role->name === $roleName;
    }

    public function getImageAttribute($value)
    {
        if (strpos($value, 'http') === 0) {
            return $value;
        }
        return asset('storage/' . $value);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole('admin');
    }

    /**
     * Get the user's name.
     */
    public function getFilamentName(): string
    {
        return $this->fullname;
    }
}