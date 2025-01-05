<?php

namespace App\Models;

use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

class Copy extends Model
{
    use HasFactory , HasTranslations , UploadTrait;

    const IMAGEPATH = 'imagesfolder' ; 
    public $translatable = ['name' , 'desc'];

    protected $fillable = ['name' , 'image' , 'desc' , 'is_active'];


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
