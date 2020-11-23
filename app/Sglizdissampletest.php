<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sglizdissampletest extends Model
{
    
    protected $primaryKey = 'test_id';
    public function sglizdissamples()
    {
      return $this->hasmany('App\Samples','sample_id','sample_id');
    }

     public function pathogen()
     {
   		return $this->hasOne('App\Pathogen','pathogen_id','pathogen_id');
   	 }


   	 public function antibiotic()
     {
   		return $this->hasOne('App\Antibiotic','antibiotic_id','antibiotic_id');
   	 }

    public function testsensitivity()
     {
      return $this->hasOne('App\Testsensitivitie','test_sensitivity_id','test_sensitivity_id');
     }

    
}

