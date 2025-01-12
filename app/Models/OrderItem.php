<?php

namespace App\Models;

use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Support\Facades\Storage;
use Str;

class OrderItem extends Model
{
    use HasFactory ,UploadTrait;

    const IMAGEPATH = 'order_items';
    const STATUSES = [
        'in_cart'                 => 'in_cart',
        'preparing'               => 'preparing',
        'prepared'                => 'prepared',
        'on_the_way'                => 'on_the_way',
        'delivered'               => 'delivered',
        'canceled'                => 'canceled',
    ];

    const RECIPE_STATUS = [
        'pending'   => 'pending',
        'accepted'  => 'accepted',
        'rejected'  => 'rejected',
    ];

    protected $fillable = [
        'order_num',
        'order_id',
        'user_id',
        'product_id',
        'price',
        'total',
        'quantity',
        // 'status', TODO: Not used in current ui
        // 'shipping_status', TODO: Not used in current ui
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

//    protected $appends = [
//        'status_name',
//        'shipping_status_name',
//    ];

    public static function boot()
    {
        parent::boot();

        self::saving(function ($model) {
            if (empty($model->order_num)) {
                $model->setOrderNumAttribute();
            }
        });
    }

    public function setOrderNumAttribute()
    {
        $orderNum = strtoupper(substr(Str::uuid()->toString(), 0, 8));
        if (static::whereOrderNum($orderNum)->exists()) {
            $this->setOrderNumAttribute();
        }
        $this->attributes['order_num'] = $orderNum;
    }

    public function getStatusNameAttribute()
    {
        return __('enums.order_statuses.' . $this->status );
    }

    public function getٍShippingStatusNameAttribute()
    {
        return __('enums.order_statuses.' . $this->shipping_status );
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function setRecipeAttribute($value)
    {
        if($value){
            return $this->attributes['recipe'] = $this->StoreFile(static::IMAGEPATH, $value);
        }
    }

    public function getRecipeAttribute($value)
    {
        if($value)
            return Storage::disk(env('FILESYSTEM_DRIVER'))->url($value);
    }

}
