<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sglizdissample extends Model
{
    protected $primaryKey ='sample_id';
    public function institutions()
    {
   		return $this->hasOne('App\Institutions','institution_id','institution_id');
   	}
	
	public function species()
	{
   		return $this->hasOne('App\Species','species_id','species_id');
   	}


   	public function breed()
   	{
   		return $this->hasOne('App\Breed','breed_id','breed_id');
   	}

	public function Specimen()
	{
   		return $this->hasOne('App\Specimen','specimen_id','specimen_id');
   	}


   	public function specimencollectionlocation()
  	 {
    return $this->hasOne('App\Specimencollectionlocation','specimen_location_id','specimen_location_id');
     }

     public function testmethod(){
   		return $this->hasOne('App\Testmethod','test_method_id','test_method_id');
   	}


     public function pathogen()
     {
   		return $this->hasOne('App\Pathogen','pathogen_id','pathogen_id');
   	 }


     public function sglizdissampletest(){
      return $this->hasMany('App\Sglisampletest','sample_id','sample_id');
    }
}
