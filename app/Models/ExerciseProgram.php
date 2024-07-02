<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExerciseProgramme extends Model
{
    use HasFactory;

    protected $fillable = ['exercise_id', 'programme_id', 'rep', 'order', 'break', 'weight', 'day'];

    public function programme()
    {
        return $this->belongsTo(Program::class);
    }

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }
}
