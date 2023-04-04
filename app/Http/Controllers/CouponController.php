<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();


use Auth;
class CouponController extends Controller
{
    public function __construct(){


    }
     public function AuthLogin(){

        if(Session::get('login_normal')){

            $admin_id = Session::get('admin_id');
        }else{
            $admin_id = Auth::id();
        }
            if($admin_id){
                return Redirect::to('dashboard');
            }else{
                return Redirect::to('admin')->send();
            }


    }

	public function unset_coupon(){
		$coupon = Session::get('coupon');
        if($coupon==true){

            Session::forget('coupon');
            return redirect()->back()->with('message','Xóa mã khuyến mãi thành công');
        }
	}
    public function insert_coupon(){
        $this->AuthLogin();
    	return view('admin.coupon.insert_coupon');
    }
    public function delete_coupon($coupon_id){
        $this->AuthLogin();
    	$coupon = Coupon::find($coupon_id);
    	$coupon->delete();
    	Session::put('message','Xóa mã giảm giá thành công');
        return Redirect::to('list-coupon');
    }
    public function list_coupon(){
        $this->AuthLogin();
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y');
    	$coupon = Coupon::orderby('coupon_id','DESC')->paginate(5);
    	return view('admin.coupon.list_coupon')->with(compact('coupon','today'));
    }
    public function insert_coupon_code(Request $request){
         $this->AuthLogin();
    	$data = $request->all();

    	$coupon = new Coupon;
        $startDate = Carbon::createFromFormat('d/m/Y', $data['coupon_date_start'])->format('Y-m-d H:i:s');
        $endDate = Carbon::createFromFormat('d/m/Y', $data['coupon_date_end'])->format('Y-m-d H:i:s');
    	$coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_date_start = $startDate;
        $coupon->coupon_date_end = $endDate;
    	$coupon->coupon_number = $data['coupon_number'];
    	$coupon->coupon_code = $data['coupon_code'];
    	$coupon->coupon_time = $data['coupon_time'];
    	$coupon->coupon_condition = $data['coupon_condition'];
    	$coupon->save();

    	Session::put('message','Thêm mã giảm giá thành công');
        return Redirect::to('insert-coupon');


    }
}
