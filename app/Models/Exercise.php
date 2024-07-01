<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lang',
        'image',
    ];

    public function muscles()
    {
        return $this->belongsToMany(Muscle::class, 'exercise_muscle');
    }
}