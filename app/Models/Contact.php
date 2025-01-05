<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
       'user_id' ,'name' ,'country_code' ,'phone' ,'email' , 'message'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullPhoneAttribute()
    {
        return $this->attributes['country_code'] . $this->attributes['phone'];
    }
}
