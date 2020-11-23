<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testmethod extends Model
{
	protected $primaryKey = 'test_method_id';
    
     public function testmethod(){
   		return $this->hasOne('App\Testmethod','test_method_id','test_method_id');
   	}
}
