<?php
session_start();

?> 
@extends('head.navbar') 
@section('vue') @if (\Session::has('success'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <p>{{ \Session::get('success') }}</p>
</div><br /> @endif
<div class="card">
    <div class="card-header">
        <h3>แก้ไขสินค้า</h3>
    </div>
    <div class="card-body">
        <form method="post" action="{{action('ProductController@update', $id_product)}}" enctype="multipart/form-data">
            @csrf @foreach($product as $products)
            <input name="_method" type="hidden" value="PATCH">
            <div class="form-group">
                <label for="nameproduct">ชื่อสินค้า:</label>
                <input type="text" class="form-control" name="nameproduct" id="nameproduct" value="{{$products->name_product}}">
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
                <input type="number" class="form-control" name="priceproduct" id="priceproduct" value="{{$products->price_product}}">
            </div>
            <div class="form-group">
                <label for="amountproduct">จำนวนสินค้า:</label>
                <input type="number" class="form-control" name="amountproduct" id="amountproduct" value="{{$products->amount_product}}">
            </div>
            <div class="form-group">
                <label for="imgproduct">รูปภาพ:</label>
                <input type="hidden" name="old" value="{{$products->img_product}}">
                <input name="image" type="file" class="form-control-file">
            </div>
            <button type="submit" class="btn btn-success">Update</button> @endforeach

    </div>
    </form>
</div>
</div>
@endsection