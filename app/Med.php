<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Med extends Model
{

		protected $fillable = ['name','type_id','dosage','ingredient'];
		
		public function type() {

    		 return $this->belongsTo(Type::class);

		}


    }
