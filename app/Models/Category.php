<?php

namespace App\Models;

use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory , HasTranslations , UploadTrait;

    public $translatable = ['name' , 'desc'];

    protected $fillable = ['name' , 'image' , 'desc' , 'parent_id','is_active'];
    

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
    
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function childs(){
        return $this->hasMany(self::class,'parent_id');
    }

    public function parent(){
         return $this->belongsTo(self::class,'parent_id');
    }

    public function setImageAttribute($value)
    {
        if($value){
          return $this->attributes['image'] = $this->StoreFile('categories' , $value);
        }
    }


}
