<?php
session_start();
$_SESSION["user"];

?> 
@extends('head.navbar') 
@section('vue')
<div class="row">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>รูปภาพ</th>
                <th>ชื่อสินค้า</th>
                <th>จำนวน / ชิ้น</th>
                <th>ราคาทั้งหมด</th>
                <th>วันที่ซื้อ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ordered as $ordered)

            <tr>
                <td><img class="card-img-top" 
                    src="{{asset("../../image/".$ordered->img_product)}}" 
                    alt="Card image" style="width:150px;height:100px"></td>
                <td>{{ $ordered->name_product }}</td>
                <td>{{ $ordered->total_amount }}</td>
                <td>{{ $ordered->total_price }}</td>
                <td>{{ $ordered->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection