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


}
