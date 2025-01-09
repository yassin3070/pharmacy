<?php

namespace App\Models;

use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasFactory , HasTranslations , UploadTrait;

    const IMAGEPATH = 'products' ;
    public $translatable = ['name' , 'desc'];

    protected $fillable = ['name' , 'image' , 'desc' , 'is_active','category_id','price','need_recipe','qrcode','decoded_qrcode'];


    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }


    public function setImageAttribute($value)
    {
        if($value){
          return $this->attributes['image'] = $this->StoreFile(static::IMAGEPATH, $value);
        }
    }

    public function getImageAttribute($value)
    {
        if($value)
        return Storage::disk(env('FILESYSTEM_DRIVER'))->url($value);
    }

    public function setQrcodeAttribute($value)
    {
        if($value){
            return $this->attributes['qrcode'] = $this->StoreFile(static::IMAGEPATH, $value);
        }
    }

    public function getQrcodeAttribute($value)
    {
        if($value)
            return Storage::disk(env('FILESYSTEM_DRIVER'))->url($value);
    }


    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function scopeOrderByOption($query, $option)
    {
        switch ($option) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;

            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;

            case 'rating_asc':
                $query->withAvg('rates', 'rate')->orderBy('rates_avg_rate', 'asc');
                break;

            case 'rating_desc':
                $query->withAvg('rates', 'rate')->orderBy('rates_avg_rate', 'desc');
                break;

            default:
                $query->latest();
                break;
        }

        return $query;
    }

    public function scopeFilterByOptions($query, $filters)
    {
        // Filter by category
        if (!empty($filters['category'])) {
            $query->where('category_id', $filters['category']);
        }


        // Filter by rating
        if (!empty($filters['rating'])) {
            // Join with a subquery to calculate the average rating
            $query->whereIn('id', function ($subquery) use ($filters) {
                $subquery->select('product_id')
                    ->from('rates')
                    ->groupBy('product_id')
                    ->havingRaw('AVG(rate) >= ?', [$filters['rating']]);
            });
        }

        // Filter by price range
        if (!empty($filters['min_price']) && !empty($filters['max_price'])) {
            $query->whereBetween('price', [$filters['min_price'], $filters['max_price']]);
        }

        return $query;
    }

}
