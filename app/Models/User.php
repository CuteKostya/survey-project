<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property string $name
 * @property string $email
 * @property bool $admin
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;


    protected $fillable
        = [
            'name', 'email', 'avatar',
            'password',
        ];

    protected $hidden
        = [
            'password',
            'remember_token',
        ];
}
