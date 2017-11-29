<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrganizationPayment extends Model
{
    public function organization(){
    	$this->hasOne('App\Organization');
    }
}
