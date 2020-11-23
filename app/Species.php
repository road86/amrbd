<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    protected $primaryKey = 'species_id';
    
   	public function species(){
   		return $this->hasOne('App\Species','species_id','species_id');
   	}

}
