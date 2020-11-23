<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Summarizeinumsampletest extends Model
{
    protected $primaryKey ='test_id';
   
     
    public function pathogen()
     {
   		return $this->hasOne('App\Pathogen','pathogen_id','pathogen_id');
   	 }

   	public function antibiotic()
     {
   		return $this->hasOne('App\Antibiotic','antibiotic_id','antibiotic_id');
   	 }


   	 public function user()
     {
   		return $this->hasOne('App\User','id','created_by');
   	 }
}
