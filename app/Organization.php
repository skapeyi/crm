<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    public function payments(){
    	return $this->hasMany('App\OrganizationPayment')->orderBy('payment_date','DESC');
    }
}
