<?php
session_start();

?> 
@extends('head.navbar') 
@section('vue')
<h2>สินค้าทั้งหมด</h2>
<hr>
<div class="row">
    @foreach($typeProduct as $typeProducts)
    <div class="card col-sm-3">
        <img class="card-img-top" src="{{ asset("../../image/".$typeProducts->img_product)}}" alt="Card image" style="width:50%">
        <div class="card-body">
            <h4 class="card-title">{{$typeProducts->name_product}}</h4>
            <p class="card-text">ราคา: {{$typeProducts->price_product}} บาท
                <br>จำนวน: {{$typeProducts->amount_product}} ชิ้น</p>
            <a href="{{action('ProductController@show', $typeProducts->id_product)}}">
                <button type="button" class="btn btn-info">สั่งซื้อ</button>
            </a>
            <br>
        </div>
        
    </div>

    @endforeach
</div>
@endsection