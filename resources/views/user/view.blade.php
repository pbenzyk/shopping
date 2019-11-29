<?php
session_start();

?> 
@extends('head.navbar') 
@section('vue')
<div class="row">
    @foreach($typeProduct as $typeProducts)
    <div class="card col-sm-3">
        <a href="{{action('TypeProductController@show', $typeProducts->id_type)}}">
            <img class="card-img-top" src="{{ asset("../../image/".$typeProducts->img_type)}}" alt="Card image" style="width:50%">
            <div class="card-body">
                <h4 class="card-title">{{$typeProducts->name_type}}</h4>
            </div>
        </a>
    </div>

    @endforeach
</div>
@endsection