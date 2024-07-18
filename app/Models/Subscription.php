<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'stripe_id',
        'stripe_subscription_id',
        'stripe_plan',
        'ends_at',
        'isCancelled',
    ];

    protected $dates = [
        'ends_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isActive()
    {
        return $this->isCancelled == false;
    }

    public function isCancelled()
    {
        return $this->isCancelled == true;
    }
}