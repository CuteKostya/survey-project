<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 *
 */
class Answer extends Authenticatable
{
    use HasFactory, Notifiable;


    protected $fillable
        = [
            'id', 'defendants_id', 'questions_id',
            'text',
        ];


}
