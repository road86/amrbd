<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Antibiotic extends Model
{

	protected $primaryKey = 'antibiotic_id';


	public $table = 'antibiotics';
    protected $fillable = [
        'antibiotic_id', 'antibiotic_name', 'created_by'
    ];
    


}





