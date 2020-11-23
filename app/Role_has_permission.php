<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role_has_permission extends Model
{
    
  // protected $primaryKey = 'permission_id';
    
    protected $primaryKey = ['permission_id', 'role_id'];
    public $incrementing = false;
}
