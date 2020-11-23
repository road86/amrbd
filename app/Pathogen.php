<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Pathogen extends Model
{
	protected $primaryKey ='pathogen_id';
	protected $table = 'pathogen';
   	public function pathogen(){
   		return $this->hasOne('App\Pathogen','pathogen_id','pathogen_id');
   	}
}
