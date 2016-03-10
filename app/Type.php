<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    		public function med() {
    
    		 return $this->hasMany(Med::class);
    
    		}}


