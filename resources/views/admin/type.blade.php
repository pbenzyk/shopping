<?php
session_start();

?> 
@extends('head.navbar') 
@section('vue') @if (\Session::has('success'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <p>{{ \Session::get('success') }}</p>
</div><br /> @endif
<h3>หมวดหมู่ <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add"> เพิ่ม</button> </h3>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>ชื่อหมวดหมู่</th>
            <th>รูปภาพ</th>
            <th colspan="2">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=1;?> @foreach($typeProduct as $typeProducts)
        <tr>
            <td>{{$i++}}</td>
            <td>{{$typeProducts['name_type']}}</td>
            <td>
                <img src="{{ asset("../../image/".$typeProducts->img_type)}}" style="width:60px;height:60px;">
            </td>
            <td><a href="{{action('TypeProductController@edit', $typeProducts->id_type)}}" class="btn btn-warning">Edit</a></td>
            <td>
                <form action="{{action('TypeProductController@destroy', $typeProducts->id_type)}}" method="post">
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
                <h4 class="modal-title">เพิ่มหมวดหมู่</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="POST" action="{{action('TypeProductController@store')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="typename">ชื่อหมวดหมู่:</label>
                        <input type="text" class="form-control" name="typename" id="typename" placeholder="กรอกชื่อหมวดหมู่" required>
                    </div>
                    <div class="form-group">
                        <label for="typename">รูปภาพ:</label>
                        <input name="image" type="file" class="form-control-file " required>
                    </div>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
                    <button type="submit" class="btn btn-success">บันทึก</button>
                </form>
            </div>

        </div>
    </div>
</div>