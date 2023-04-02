<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'name', 'status','description'
    ];
    
 	protected $table = 'tbl_warehouse';

 	
}
