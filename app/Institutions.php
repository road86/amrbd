<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Institutions extends Model
{
	protected $primaryKey = 'institution_id';
	protected $table = 'institution';
   	public function institutions(){
   		return $this->hasOne('App\Institutions','institution_id','institution_id');
   	}
}
