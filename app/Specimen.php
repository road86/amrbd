<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specimen extends Model
{
    protected $primaryKey = 'specimen_id';
    public function Specimen(){
   		return $this->hasOne('App\Specimen','specimen_id','specimen_id');
   	}
}
