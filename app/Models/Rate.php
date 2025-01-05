<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Rate extends Model
{
    use HasFactory;

    protected $fillable = [
        'rate',
        'comment',
        'user_id',
        'branch_id',
        'order_id',
        'is_approved',
        'rateable_id',
        'rateable_type',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
    ];

    public function rateable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function store(): HasOneThrough
    {
        return $this->hasOneThrough(Store::class, Branch::class, 'id', 'id', 'branch_id', 'store_id');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', 1);
    }

    public function scopeByBranch($query, $branchId)
    {
        return $query->where('branch_id', $branchId);
    }

}
