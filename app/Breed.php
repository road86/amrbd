<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Species;

class Breed extends Model
{
   	protected $primaryKey = 'breed_id';
   	
   	protected $table = 'breed';

   	public function species(){
   		return $this->hasOne('App\Species','species_id','species_id');
   	}
}
