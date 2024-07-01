<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = ['name', 'description', 'lang', 'image'];

    public function muscles()
    {
        return $this->belongsToMany(Muscle::class, 'exercises_muscles');
    }

    public function programs()
    {
        return $this->belongsToMany(Program::class, 'exercises_programs')
                    ->withPivot(['day', 'order', 'rep', 'weight', 'break']);
    }
}

