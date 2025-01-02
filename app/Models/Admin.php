<?php

namespace App\Models;

use App\Concerns\HasRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;
class Admin extends User
{
    // use HasFactory,Notifiable;
    use HasApiTokens, HasFactory, Notifiable, TwoFactorAuthenticatable, HasRole;

    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'phone_number',
        'super_admin',
        'status',
    ];
}
