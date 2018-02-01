<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    //
    protected $table = "queue";


    //relationships

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }
}
