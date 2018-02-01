<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //
    protected $table = "ticket";

    public function queue()
     {

    	return $this->belongsTo('App\Queue', 'queue_id');
    }
}
