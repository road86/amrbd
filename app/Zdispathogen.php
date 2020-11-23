<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Pathogen;
use App\Antibiotic;

class Zdispathogen extends Model
{
    protected $primaryKey = 'zdis_id';

    public function pathogen()
     {
   		return $this->hasOne('App\Pathogen','pathogen_id','pathogen_id');
   	 }

   	 public function antibiotic()
     {
   		return $this->belongsTo('App\Antibiotic','antibiotic_id','antibiotic_id');
   	 }
}
