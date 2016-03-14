<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedUse extends Model
{


	protected $fillable = ['med_id','user_id','use'];

    protected $table = 'med_uses';

		public function med() {
    
    		 return $this->belongsTo(Med::class);
    
    		}


		public function user() {
    
    		 return $this->belongsTo(User::class);
    
    		}

}
