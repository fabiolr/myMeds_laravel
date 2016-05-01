<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{

public function who() {
    

     return $this->belongsTo('App\User','friend_id');
    
 }

}
