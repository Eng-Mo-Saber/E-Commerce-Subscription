<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'type',
        'duration_in_days',
        'description',
        'service_id'
    ];

    public function user_subscriptions(){
        return $this->hasMany(UserSubscription::class);
    }

    public function service(){
        return $this->belongsTo(Service::class);
    }
}
