<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Warehouse;
use App\Ware_Product;
use App\Product;
use Auth;
use Session;
class WarehouseController extends Controller
{
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
    public function select_warehouse(Request $request){
        $data = $request->all();
        $warehouse_find = Ware_Product::where('product_id',$data['id'])->where('warehouse_id',$data['value'])->first();
        if($warehouse_find){
            echo $warehouse_find->quantity;
        }else{
            echo '0';
        }
    }
    public function add_warehouse(){
        $this->AuthLogin();
    	return view('admin.warehouse.add');
    }
    public function add_import_warehouse(){
        $this->AuthLogin();
        $product = Product::orderBy('product_id','DESC')->get();
        $warehouse = Warehouse::orderBy('id','DESC')->get();
        $ware_product = Ware_Product::with('product','warehouse')->orderBy('id','DESC')->get();

        return view('admin.warehouse.import_warehouse',compact('product','warehouse','ware_product'));
    }
    public function delete_ware_pro($id){
        $warehouse = Ware_Product::find($id);
        $warehouse->delete();
        Session::put('message','Xóa sản phẩm trong kho thành công');
        return redirect()->back();
    }
	public function save_warehouse(Request $request){
        $this->AuthLogin();
    	$data = $request->all();
    	$warehouse = new Warehouse();
    	$warehouse->name = $data['name'];
    	$warehouse->status = $data['status'];
    	$warehouse->description = $data['description'];
    	$warehouse->save();
    	Session::put('message','Thêm nhà kho thành công');
    	return redirect()->back();
    }
    
    public function all_warehouse(){
        $this->AuthLogin();

        $warehouse = Warehouse::orderBy('id','DESC')->paginate(5);

    	return view('admin.warehouse.list')->with(compact('warehouse'));


    }
  
    public function edit_warehouse($id){
        $this->AuthLogin();

      	$warehouse = Warehouse::find($id);

        return view('admin.warehouse.edit')->with(compact('warehouse'));
    }
    public function add_ware_pro(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $warehouse_find = Ware_Product::where('product_id',$data['product_id'])->where('warehouse_id',$data['warehouse_id'])->first();
        if($warehouse_find){
            Session::put('message','Sản phẩm đã tồn tại ở kho');
            return redirect()->back();
        }else{
        $warehouse = new Ware_Product();
        $warehouse->product_id = $data['product_id'];
        $warehouse->warehouse_id = $data['warehouse_id'];
        $warehouse->quantity = $data['quantity'];
        $warehouse->save();
        Session::put('message','Thêm sản phẩm vào kho thành công');
        return redirect()->back();
        }
    }
    public function update_warehouse(Request $request, $id){
    
    	$this->AuthLogin();
    	$data = $request->all();
    	$warehouse = Warehouse::find($id);
    	$warehouse->name = $data['name'];
    	$warehouse->status = $data['status'];
    	$warehouse->description = $data['description'];
    	$warehouse->save();
    	Session::put('message','Cập nhật nhà kho thành công');
    	return redirect()->back();
    }
   	public function delete_warehouse($id){
   		$warehouse = Warehouse::find($id);
   		$warehouse->delete();
    	Session::put('message','Xóa nhà kho thành công');
    	return redirect()->back();

   	}
  
}
