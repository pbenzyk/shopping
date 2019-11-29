<?php
session_start();
$user = $_SESSION['user']; 
?>    
@extends('head.navbar') 
@section('vue') @foreach($product as $products)
    <?php  $path = storage_path('app/');
    ?>
    <h2>{{$products->name_product}}</h2>
    <hr>
    <div class="row">
        <div class="col">
            <img class="card-img-top" src="{{asset("../../image/".$products->img_product)}}" alt="Card image" style="width:50%">
        </div>
        <div class="col">
            <form method="POST" action="{{action('OrderController@check')}}">
                {{ csrf_field() }}
                @if (\Session::has('error'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <p>{{ \Session::get('error') }}</p>
                </div>@endif
                <div class="form-group col-sm-3">
                    <h4 class="card-title">{{$products->name_product}}</h4>
                    <p class="card-text">ราคา: {{$products->price_product}} บาท
                        <br>จำนวน: {{$products->amount_product}} ชิ้น</p>
                    <label for="amount">จำนวนที่สั่งซื้อ:</label>
                    <input type="hidden" name="user" value="{{$user}}">
                    <input type="hidden" name="product" value="{{$products->id_product}}">
                    <input type="hidden" name="price" value="{{$products->price_product}}">
                    <input type="hidden" name="old_amount" value="{{$products->amount_product}}">
                    <input type="number" class="form-control" id="amount" name="amount" value="1">
                </div>
                <button type="submit" class="btn btn-info">สั่งซื้อ</button>
            </form>
        </div>
    </div>

    @endforeach
    </div>
    @if (\Session::has('open'))
    <script>
        $(document).ready(function(){
        // Show the Modal on load
        $("#myModal").modal({backdrop: false});
        $("#myModal").modal("show");
        
    });
    </script>
    @endif @if (\Session::has('openM'))
    <script>
        $(document).ready(function(){
        // Show the Modal on load
        $("#myModalM").modal({backdrop: false});
        $("#myModalM").modal("show");
        
    });
    </script>
    <!-- alert -->
    <div class="modal fade" id="myModalM">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">ยืนยันการสั่งสินค้า</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <center>
                        <h5 style="color:red;">{{ \Session::get('openM') }}</h5>
                    </center>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    @endif
    <!-- Num card -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">ยืนยันการสั่งสินค้า</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <form method="POST" action="{{action('OrderController@checkCard')}}">
                    {{ csrf_field() }} @foreach($product as $products)
                    <div class="modal-body">
                        <h5>กรุณากรอกรหัสบัตรเครดิต</h5>
                        <div class="form-group">
                            <label for="usr">Card Number:</label>
                            <input name="num" type="num" id="card-number" class="form-control" maxlength="16" />
                        </div>
                    </div>
                    <input type="hidden" name="user" value="{{$user}}">
                    <input type="hidden" name="product" value="{{$products->id_product}}">
                    <input type="hidden" name="price" value="{{$products->price_product}}">
                    <input type="hidden" name="old_amount" value="{{$products->amount_product}}">
                    <input type="hidden" name="amount" value="{{Session::get('open') }}"> @endforeach

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info">สั่งซื้อ</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection