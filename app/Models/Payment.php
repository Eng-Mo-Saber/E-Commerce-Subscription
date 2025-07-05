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
        'type_payment',

    ];
}
