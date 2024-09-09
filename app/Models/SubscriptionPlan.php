<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubscriptionPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'amount',
        'description',
        'currency',
        'billing_cycle',
        'subscription_expiration',
        'type',
        'process_identifier',
        'site_id',
    ];

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }
}
