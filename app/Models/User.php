<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $appends = ['image_url','full_name','referral_url'];
    protected $with = ['role'];
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'role_id',
        'state',
        'dob',
        'password',
        'referral_id',
        'balance',
        'is_active',
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
    public function referredUsers()
    {
        return $this->hasMany(User::class, 'referral_id','id');
    }
    public function referrer()
    {
        return $this->belongsTo(User::class, 'referral_id', 'id');
    }        
    public function image(){
        return $this->morphOne(File::class,'fileable');
    }
    public function getImageUrlAttribute(){
        if($this->image){
            return $this->image->full_url;
        }else{
            return 'https://randomuser.me/api/portraits/men/85.jpg';
        }
    }
    public function getLastActiveReadableAttribute(){
        if($this->last_active){
            return \Carbon\Carbon::parse($this->last_active)->diffForhumans();
        }
        return 'N/A';
    }
    public function getFullNameAttribute(){
        return strtoupper($this->first_name . ' ' . $this->last_name);
    }
    public function role(){
        return $this->belongsTo(Role::class);
    }
    public function getReferralUrlAttribute(){
        $query='?_agent_id=insurance&utm_source=';
        $link = env('APP_URL'). $query .'/'.$this->first_name . '/'.$this->id ;
        return $link;
    }
}
