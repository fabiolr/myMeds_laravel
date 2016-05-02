<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

        public function meds() {

            return $this->belongsToMany(Med::class)->withPivot('expiration','qty','id');;

        }

        public function uses() {

            return $this->hasMany(MedUse::class);

        }

        public function friends() {
    
            return $this->hasManyThrough('App\User', 'App\Friendship', 'friend_id', 'id');
    
            }


        public function friendships() {
    
            return $this->hasMany(Friendship::class);
    
            }



}

