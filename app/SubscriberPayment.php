<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriberPayment extends Model
{
    public function subscriber(){
    	$this->hasOne('App\Subscriber');
    }
}
