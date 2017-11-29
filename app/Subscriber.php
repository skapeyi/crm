<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    public function payments(){
    	return $this->hasMany('App\SubscriberPayment')->orderBy('payment_date','desc');
    }
}
