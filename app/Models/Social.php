<?php

namespace App\Models;

use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

class Social extends Model
{
    use HasFactory , HasTranslations , UploadTrait;

    const IMAGEPATH = 'socials' ; 
    public $translatable = ['name'];

    protected $fillable = ['name' , 'image' , 'link' , 'is_active'];


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
        return Storage::disk('s3')->url($value);

    }



}
