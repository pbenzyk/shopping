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
        <h3>แก้ไขหมวดหมู่</h3>
    </div>
    <div class="card-body">
        <form method="post" action="{{action('TypeProductController@update', $id_type)}}" enctype="multipart/form-data">
            @csrf @foreach($typeProduct as $typeProducts)
            <input name="_method" type="hidden" value="PATCH">
            <div class="form-group">
                <label for="typename">ชื่อหมวดหมู่:</label>
                <input type="text" class="form-control" name="typename" id="typename" value="{{$typeProducts->name_type}}" required>
            </div>
            <div class="form-group">
                <label for="typename">รูปภาพ:</label>
                <input type="hidden" name="old" value="{{$typeProducts->img_type}}">
                <input name="image" type="file" class="form-control-file" value="{{ old('img_type') }}">
            </div>
            <button type="submit" class="btn btn-success">Update</button> @endforeach
    </div>
    </form>
</div>
</div>
@endsection