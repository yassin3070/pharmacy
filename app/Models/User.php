<?php

namespace App\Models;

use App\Http\Resources\Api\UserResource;
use App\Traits\EmailTrait;
use App\Traits\SmsTrait;
use App\Traits\UploadTrait;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use libphonenumber\PhoneNumber;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable , HasRoles , SmsTrait , UploadTrait , EmailTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'phone',
        'email',
        'password',
        'image',
        'is_active',
        'is_blocked',
        'is_approved',
        'is_phone_verified',
        'is_email_verified',
        'lang',
        'is_notify',
        'code',
        'code_expire',
        'lat',
        'lng',
        'address',
        'verfiy_token',
        'wallet_balance',
        'city_id',
        'user_type',
        'bio',
        'experience',
        'university',
        'graduation_year',
        'qualification',
        'job'


    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function isAdmin(){
        return $this->user_type === 1;
    }

    public function isUser(){
        return $this->user_type === 2;
    }

    public function isProvider(){
        return $this->user_type === 3;
    }

    public function isActive(){
        return $this->is_active === 1;
    }

    public function userType()
    {
       return $this->belongsTo(UserType::class , 'user_type');
    }

    public function scopeProviders($query)
    {
       return $query->where(['is_active' => 1 , 'user_type' => 3]);
    }

    public function scopeAdmins($query)
    {
       return $query->where(['is_active' => 1 , 'user_type' => 1]);
    }

    public function setImageAttribute($value)
    {
        if ($value) {
            // Check if an authenticated user exists and has an existing image
            if (auth()->check() && auth()->user()->image && auth()->user()->image != asset('dashboard/logo/hwzn.png')) {
                Storage::disk(env('FILESYSTEM_DRIVER'))->delete(auth()->user()->getRawOriginal('image'));
            }

            // Store the new image and set the attribute
            $this->attributes['image'] = $this->StoreFile('users', $value);
        }
    }


    public function getImageAttribute($value)
    {
        if($value)
        return Storage::disk("".env('FILESYSTEM_DRIVER')."")->url($value);

        return asset('dashboard/logo/hwzn.png');

    }

    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = $value;

        if (!empty($value) && !empty($this->attributes['last_name'])) {
            $this->attributes['name'] = $value . ' ' . $this->attributes['last_name'];
        }
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = $value;

        if (!empty($value) && !empty($this->attributes['first_name'])) {
            $this->attributes['name'] = $this->attributes['first_name'] . ' ' . $value;
        }
    }

    public function setNameAttribute($value)
    {
        if (empty($value) )
        {
         if(!empty( $this->attributes['first_name']) ) {
            $this->attributes['name'] = $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
        }}else {$this->attributes['name'] =$value;}
    }
   /* public function getNameAttribute()
    {
        return $this->attributes['first_name'] ." ". $this->attributes['last_name'];
    }*/



    public function setPasswordAttribute($value)
    {
        if($value)
        return $this->attributes['password'] = bcrypt($value);
    }


    public function getCountryCodeAttribute($value)
    {
        if (empty($value)) {
            try {

                $countryInfo =  getCountryFromPhoneNumber($this->phone);

                if ($countryInfo !== null) {
                    $countryCode = $countryInfo['country_code']; // E.g., 'US'
                    $countryName = $countryInfo['country_name']; // E.g., 'United States'

                    return $countryCode;
                } else {
                    // Invalid phone number
                }
            } catch (\Exception $ex) {
            }
        }
        return $value;
    }

    // public function getPhoneAttribute()
    // {
    //     $formattedNumber = formatPhoneNumber($this->attributes['phone'], $this->country_code);

    //     if ($formattedNumber !== null) {
    //         // Use the formatted number
    //         return $formattedNumber; // E.g., (650) 555-1234
    //     } else {
    //         // Invalid phone number or country code
    //     }
    // }

    public function markAsPhoneActive()
    {
        $this->update(['code' => null, 'code_expire' => null,
                       'is_phone_verified' => true ,'verfiy_token' => null ]);
        return $this;
    }

    public function markAsEmailActive()
    {
        $this->update(['code' => null, 'code_expire' => null,
                       'is_email_verified' => true ,'verfiy_token' => null ]);
        return $this;
    }


    public function sendVerificationCode()
    {
        $this->update([
            'code'        => $this->activationCode(),
            'verfiy_token' => bin2hex(random_bytes(16)),
            'code_expire' => Carbon::now()->addMinute(),
        ]);

        $msg = trans('apis.activeCode');
        $this->sendSms($this->phone, $msg . $this->code);
        return ['user' => new UserResource($this->refresh())];
    }


    public function sendVerificationMail()
    {

        $this->update([
            'code'        => $this->activationCode(),
            'verfiy_token' => bin2hex(random_bytes(16)),
            'code_expire' => Carbon::now()->addMinute(),
        ]);

        $msg = trans('apis.activeCode');
        $this->sendMail($this->email, $msg . $this->code);
        return ['user' => new UserResource($this->refresh())];

    }


    private function activationCode()
    {
        return 1234;
        return mt_rand(1111, 9999);
    }

    public function logout()
    {
        // $this->tokens()->delete();
        $this->currentAccessToken()->delete();
        if (request()->device_id) {
            $this->devices()->where(['device_id' => request()->device_id])->delete();
        }
        return true;
    }

    public function devices()
    {
        return $this->morphMany(Device::class, 'morph');
    }

    public function getRoleAttribute()
    {
        if($this->roles->first()){

          return  lang() == "ar" ? $this->roles->first()->nickname_ar : $this->roles->first()->nickname_en;
        }
    }


    public function categories()
    {
        return $this->hasMany(UserCategory::class);
    }


    public function rates()
    {
        return $this->morphMany(Rate::class , 'ref');
    }

    public function login()
    {
        $this->updateUserDevice();
        $this->updateUserLang();
        $token = $this->createToken(request()->device_type)->plainTextToken;
        return UserResource::make($this)->setToken($token);
    }

    public function updateUserLang()
    {
        if (request()->header('Lang') != null
            && in_array(request()->header('Lang'), languages())) {
            $this->update(['lang' => request()->header('Lang')]);
        } else {
            $this->update(['lang' => defaultLang()]);
        }
    }

    public function updateUserDevice()
    {
        if (request()->device_id) {
            $this->devices()->updateOrCreate([
                'device_id'   => request()->device_id,
                'device_type' => request()->device_type,
            ]);
        }
    }



    //chat relations
    public function rooms()
    {
        return $this->morphMany(RoomMember::class, 'memberable');
    }

    public function ownRooms()
    {
        return $this->morphMany(Room::class, 'createable');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function joinedRooms()
    {
        return $this->morphMany(RoomMember::class, 'memberable')
                    ->with('room')
                    ->get()
                    ->pluck('room')
                    ->sortByDesc('last_message_id');
    }



    public function getCartAttribute()
    {
        return $this->orders()->where('status', Order::STATUSES['in_cart'])->first();
    }

}
