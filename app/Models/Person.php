<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'name',
        'height',
        'mass',
        'hair_color',
        'skin_color',
        'eye_color',
        'birth_year',
        'gender'
    ];

    public static $rules = [
        'name' => 'required',
        'height' => 'required|integer',
        'mass' => 'required|integer',
        'hair_color' => 'required',
        'skin_color' => 'required',
        'eye_color' => 'required',
        'birth_year' => 'required',
        'gender' => 'required'
    ];
}
