<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['key' , 'value' , 'type'];

     /**
     * Retrieve the value of a setting with localization support.
     *
     * @param string $key
     * @return string|null
     */
    public static function getLocaleValue($key)
    {
        $localizedKey = $key . '_' . app()->getLocale();
        return self::getValue($localizedKey);
    }

    /**
     * Retrieve the value of a setting by key.
     *
     * @param string $key
     * @return string|null
     */
    public static function getValue($key)
    {
        return self::where('key', $key)->value('value');
    }

    /**
     * Retrieve the value of a setting as a URL for assets.
     *
     * @param string $key
     * @return string|null
     */
    public static function getAsset($key)
    {
        $value = self::getValue($key);
        return $value ? asset($value) : null;
    }

}
