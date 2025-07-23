<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    /**
     * The user subscription that this payment belongs to.
     *
     * @return BelongsTo
     */
    public function user_subscription()
    {
        return $this->belongsTo(UserSubscription::class);
    }

    protected $fillable = [
        'user_id',
        'subscription_id',
        'order_id',
        'amount',
        'currency',
        'status',
        'payment_method',
        'payment_date',
        'next_renewal_date',
        'kashier_response',
    ];
}
