@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Cập nhật nhà kho
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
                                <form role="form" action="{{URL::to('/update-warehouse/'.$warehouse->id)}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên nhà kho</label>
                                    <input type="text"  class="form-control"  name="name" value="{{$warehouse->name}}" placeholder="Nhà kho" >
                                </div>
                              
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả nhà kho</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="description" i placeholder="Mô tả nhà kho">{{$warehouse->description}}</textarea>
                                </div>
                               
                                
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                      <select name="status" class="form-control input-sm m-bot15">
                                        @if($warehouse->status==0)
                                            <option selected value="0">Hiển thị</option>
                                            <option value="1">Ẩn</option>
                                        @else
                                             <option value="0">Hiển thị</option>
                                            <option selected value="1">Ẩn</option>
                                        @endif

                                            
                                    </select>
                                </div>
                               
                               
                                <button type="submit" name="add_category_product" class="btn btn-info">Cập nhật</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection