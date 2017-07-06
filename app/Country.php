<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function states()
    {
    	return $this->hasMany('App\State');
    }

    public function cities()
    {
    	return $this->hasMany('App\city');
    }
}
