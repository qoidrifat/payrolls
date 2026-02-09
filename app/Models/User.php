<?php

namespace App\Models;

use Filament\Panel\Concerns\HasAvatars;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Laravel\Fortify\TwoFactorAuthenticatable;
use BezhanSalleh\FilamentShield\Support\Utils;
use BezhanSalleh\FilamentShield\FilamentShield;
use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasOne; // Import HasOne

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use HasPanelShield;
    use HasAvatars;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar_url',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function booted()
    {
        if (config('filament-shield.karyawan_user.enabled', false)) {
            FilamentShield::createRole(name: config('filament-shield.karyawan_user.name', 'karyawan_user'));
            static::created(function ($user) {
                $user->assignRole(config('filament-shield.karyawan_user.name', 'karyawan_user'));
            });
            static::deleting(function ($user) {
                $user->removeRole(config('filament-shield.karyawan_user.name', 'karyawan_user'));
            });
        }
    }

    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        if ($panel->getId() === 'admin') {
            return $this->hasRole(Utils::getSuperAdminName());
        } elseif ($panel->getId() === 'karyawan') {
            return $this->hasRole(config('filament-shield.karyawan_user.name', 'karyawan_user'));
        } else {
            return false;
        }
    }

    public function getFilamentAvatarUrl(): ?string
    {
        $avatarColumn = config('filament-edit-profile.avatar_column', 'avatar_url');
        return $this->$avatarColumn ? Storage::url("$this->$avatarColumn") : null;
    }

    public function karyawan(): HasOne // Tambahkan return type HasOne
    {
        return $this->hasOne(Karyawan::class);
    }
}
