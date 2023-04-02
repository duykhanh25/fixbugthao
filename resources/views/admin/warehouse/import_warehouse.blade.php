@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm sản phẩm theo kho
                        </header>
                         <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
                        <div class="panel-body">

                            <div class="position-center">
                                <form role="form" action="{{URL::to('/add-ware-pro')}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>

                                    <select name="product_id" class="form-control input-sm m-bot15">
                                        @foreach($product as $key => $pro)
                                         <option value="{{$pro->product_id}}">{{$pro->product_name}}</option>
                                        @endforeach
                                            
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kho</label>
                                     <select name="warehouse_id" class="form-control input-sm m-bot15">
                                           @foreach($warehouse as $key => $ware)
                                         <option value="{{$ware->id}}">{{$ware->name}}</option>
                                        @endforeach
                                            
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng</label>
                                    <input type="number" min="1" name="quantity" class="form-control" id="convert_slug" placeholder="Slug">
                                </div>
                                
                               
                                <button type="submit" name="add_post_cate" class="btn btn-info">Thêm vào kho</button>
                                </form>
                            </div>

                        </div>
                    </section>
                    <div class="table-responsive">
                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
                     <style type="text/css">
                         table.table.table-bordered.b-light {
                                        background: azure;
                                    }
                     </style>
                     <table class="table table-bordered b-light" id="myTable">
                        <thead>
                          <tr>
                            <th>Tên sản phẩm</th>
                            <th>Kho hàng</th>
                            <th>Số lượng</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($ware_product as $key => $ware)
                          <tr>
                            
                            <td>{{$ware->product->product_name}}</td>
                         
                           
                            <td>{{$ware->warehouse->name}}</td>
                            <td>{{$ware->quantity}}</td>
                            <td>
                                <a onclick="return confirm('Bạn có chắc là muốn xóa sản phẩm trong kho này ko?')" href="{{URL::to('/delete-ware-pro/'.$ware->id)}}" class="active styling-edit" ui-toggle-class="">
                                    <i class="fa fa-times text-danger text"></i>
                                </a>
                            </td>
                          </tr>
                          @endforeach
                         
                        </tbody>
                      </table>
                    
                      

                    </div>
            </div>
@endsection