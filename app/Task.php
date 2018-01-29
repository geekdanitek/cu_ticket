<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    public function isComplete() {
    	if($this->completed == 1){
    		return "Yes!!!! you completed".$this->body;
    	}else{
    		return "Do your work: ".$this->body;
    	}
    //	return $this->body;
    }
    
}
