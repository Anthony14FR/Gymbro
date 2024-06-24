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
        'muscle_id',
    ];

    public function muscle()
    {
        return $this->belongsTo(Muscle::class);
    }
}
