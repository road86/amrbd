<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Summarizeinumsample extends Model
{
    protected $primaryKey ='sample_id';
   

    public function institution()
    {
   		return $this->hasOne('App\Institutions','institution_id','institution_id');
   	}
	
	public function species()
	{
   		return $this->hasOne('App\Species','species_id','species_id');
   	}


   	public function Specimen()
	{
   		return $this->hasOne('App\Specimen','specimen_id','specimen_id');
   	}


   
     public function pathogen()
     {
   		return $this->hasOne('App\Pathogen','pathogen_id','pathogen_id');
   	 }

     
}
