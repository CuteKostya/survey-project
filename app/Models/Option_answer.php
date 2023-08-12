<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 *
 */
class Option_answer extends Authenticatable
{
    use HasFactory, Notifiable;


    protected $fillable
        = [
            'answers_id', 'options_id', 'id',
        ];


}
