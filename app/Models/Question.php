<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $question
 * @property string $text
 * @property string $type
 * @property string $options
 */
class Question extends Model
{
    use HasFactory;

    protected $fillable
        = [
            'question',
            'text',
            'type',
            'options'
        ];
    public static array $rules
        = [
            'question' => ['nullable', 'string'],
            'text' => ['nullable', 'string'],
            'type' => ['nullable', 'string'],
            'options' => ['nullable', 'string'],
        ];
}
