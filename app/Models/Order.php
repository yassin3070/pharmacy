<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id' , 'title' , 'desc' , 'payment_type','category_id',
                           'status' , 'provider_id' , 'cost' , 'order_num'];

   

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            if (empty($model->order_num)) {
                $model->order_num = rand(1111,9999);
            }
        });

        self::updating(function ($model) {
            if (empty($model->order_num)) {
                $model->order_num = rand(1111,9999);
            }
        });
    }


    public function scopeMine($query)
    {
        return $query->when(auth()->user()->isProvider(), function ($query) {
            return $query->where('provider_id', auth()->user()->id);
        })->when(auth()->user()->isUser(), function ($query) {
            return $query->where('user_id', auth()->user()->id);
        });
    }

    public function scopeCurrentStatus($query)
    {
        return $query->mine()->WhereIn('status', ['pending', 'paid', 'provider_accept', 'preparing']);

    }


    public function user()
    {
       return $this->belongsTo(User::class , 'user_id');
    }

    public function provider()
    {
       return $this->belongsTo(User::class , 'provider_id');
    }

    public function category()
    {
       return $this->belongsTo(Category::class , 'category_id');
    }


    public function getStatusNameAttribute() {
        switch ($this->status) {
        case 'pending':
             return __('apis.pending_order');
            break;
        case 'provider_accept':
            return __('apis.provider_accept');
            break;
        case 'provider_reject':
            return __('apis.provider_reject');
            break;
        case 'paid':
            return __('apis.paid');
            break;
        case 'preparing':
            return __('apis.preparing_order');
            break;
        case 'cancelled':
            return __('apis.cancelled_order');
            break;
        case 'done':
            return __('apis.done_order');
            break;

        default:
            return __('apis.pending_order');
            break;
        }
    }

  

    public function room()
    {
       return $this->hasOne(Room::class , 'order_id');
    }

}
