<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ware_Product extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'product_id', 'warehouse_id','quantity'
    ];
    
 	protected $table = 'warehouse_product';

 	public function product(){
 		return $this->belongsTo('App\Product','product_id');
 	}

 	public function warehouse(){
 		return $this->belongsTo('App\Warehouse','warehouse_id');
 	}

}
