<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExercisesPrograms extends Model
{
    use HasFactory;

    protected $table = 'exercises_programs';

    protected $fillable = ['exercise_id', 'program_id', 'rep', 'order', 'break', 'weight', 'day'];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }
}