<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Muscle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lang',
    ];

    public function exercises()
    {
        return $this->belongsToMany(Exercise::class, 'exercises_muscles');
    }
}
