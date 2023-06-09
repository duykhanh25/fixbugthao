<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'customer_id', 'shipping_id', 'order_status','order_code','created_at','order_date'
    ];
    protected $primaryKey = 'order_id';
 	protected $table = 'tbl_order';

     public function orderDetails(){
        return $this->hasMany('App\OrderDetails','order_code');
     }

}
