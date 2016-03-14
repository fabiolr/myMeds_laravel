<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedUser extends Model
{
    protected $table = 'med_user';

	protected $appends = array('interval');

    public function getInterval()
    {
        return strtoupper($this->title);    
    }
}


