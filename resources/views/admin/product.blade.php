<?php
session_start();

?> 
@extends('head.navbar') 
@section('vue') @if (\Session::has('success'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <p>{{ \Session::get('success') }}</p>
</div><br /> @endif
        <h3>สินค้า <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add"> เพิ่ม</button> </h3>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>รูปภาพ</th>
                    <th>หมวดหมู่</th>
                    <th>ชื่อสินค้า</th>
                    <th>ราคาสินค้า</th>
                    <th>จำนวน</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1; ?>
                @foreach($product as $products)
                <tr>
                    <td>{{$i++}}</td>
                    <td>
                        <img src="{{ asset("../../image/".$products->img_product)}}" style="width:60px;height:60px;">
                    </td>
                    <td>{{$products->name_type}}</td>
                    <td>{{$products->name_product}}</td>
                    <td>{{$products->price_product}}</td>
                    <td>{{$products->amount_product}}</td>
                    <td><a href="{{action('ProductController@edit', $products->id_product)}}" class="btn btn-warning">Edit</a></td>
                    <td>
                        <form action="{{action('ProductController@destroy', $products->id_product)}}" method="post">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
@endsection
<!-- The Modal Add-->
<div class="modal" id="add">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header w3-container w3-blue">
                <h4 class="modal-title">เพิ่มสินค้า</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form method="POST" action="{{action('ProductController@store')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="nameproduct">ชื่อสินค้า:</label>
                        <input type="text" class="form-control" name="nameproduct" id="nameproduct" placeholder="กรอกชื่อสินค้า">
                    </div>
                    <div class="form-group">
                        <label for="typeproduct">หมวดหมู่:</label>
                        <select class="form-control" id="typeproduct" name="typeproduct">
                        @foreach($type_product as $type_products)
                        <option value="{{$type_products->id_type}}">{{$type_products->name_type}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="priceproduct">ราคาสินค้า:</label>
                        <input type="number" class="form-control" name="priceproduct" id="priceproduct" placeholder="กรอกชื่อราคาสินค้า">
                    </div>
                    <div class="form-group">
                        <label for="amountproduct">จำนวนสินค้า:</label>
                        <input type="number" class="form-control" name="amountproduct" id="amountproduct" placeholder="กรอกจำนวนสินค้า">
                    </div>
                    <div class="form-group">
                        <label for="imgproduct">รูปภาพ:</label>
                        <input name="image" type="file" class="form-control-file ">
                    </div>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
                    <button type="submit" class="btn btn-success">บันทึก</button>
                </form>
            </div>

        </div>
    </div>
</div>