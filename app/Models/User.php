<?php

namespace App\Models;

use App\Enums\RankEnum;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'username',
        'email',
        'password',
        'level',
        'experience'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function subscription()
    {
        return $this->hasOne(Subscription::class);
    }

    public function getRankAttribute()
    {
        return RankEnum::fromLevel($this->level);
    }

    public function getNextLevelExperienceAttribute()
    {
        return 100 - $this->experience;
    }
}

