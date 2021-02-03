<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Specimen;

class SpecimenCategories extends Model
{
    protected $primaryKey = 'specimen_category_id';
	protected $table = 'specimen_categories';
    public function SpecimenCategories(){
   		return $this->hasOne('App\SpecimenCategories','specimen_category_id','specimen_category_id');
   	}
	public function Specimens(){
   		return $this->hasMany('App\Specimen','specimen_category_id','specimen_category_id');
   	}
}
