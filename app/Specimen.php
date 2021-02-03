<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SpecimenCategories;

class Specimen extends Model
{
    protected $primaryKey = 'specimen_id';
    public function Specimen(){
   		return $this->hasOne('App\Specimen','specimen_id','specimen_id');
   	}
	
	public function SpecimenCategories() {
		return $this->belongsTo('App\SpecimenCategories','specimen_category_id','specimen_category_id');
	}
}
