<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Med extends Model
{

		protected $fillable = ['name','type_id','dosage','ingredient'];
		
		public function type() {

    		 return $this->belongsTo(Type::class);

		}


        public function users() {

         return $this->belongsToMany(User::class)->withPivot('expiration','qty','id');

        }


        public function uses() {

         return $this->hasMany(MedUse::class);

        }


    }

  