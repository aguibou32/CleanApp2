<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable;

    protected $with = ['profile'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
   
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function billing_information(){
      return $this->hasOne('App\BillingInformation');
    }

    public function profile()
    {
      return $this->morphTo();
    }

    public function getHasResidentProfileAttribute()
    {
      return $this->profile_type == 'App\Resident';
    }
    
    public function getHasIndependentCollectorProfileAttribute()
    {
      return $this->profile_type == 'App\IndenpendentCollector';
    }

    public function getHasInformalCollectorProfileAttribute()
    {
      return $this->profile_type == 'App\InformalCollector';
    }


    public function getHasPickItUpCenterProfileAttribute()
    {
      return $this->profile_type == 'App\PickItUpCenter';
    }

    public function getHasBuyBackCenterProfileAttribute()
    {
      return $this->profile_type == 'App\BuyBackCenter';
    }

    public function address(){
        return $this->hasOne('App\LocationAddress');
    }

    public function dumpings(){
      return $this->hasMay('App\ReportDumping');
  }


}
