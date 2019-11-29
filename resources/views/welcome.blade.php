{{-- 
@extends('head.navbar') 
@section('vue')--}}
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Shopping</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<style>
    body.modal-open {
        background-color: beige;
    }
</style>

<body>
    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Shopping</h4>
                </div>
                <!-- Modal body -->
                <div class="modal-body">

                    @if (\Session::has('error'))
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <p>{{ \Session::get('error') }}</p>
                    </div><br /> @endif

                    <form method="POST" action="{{URL::to('login')}}">
                        @csrf
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Enter Username">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input type="password" name="password" class="form-control" id="pwd" placeholder="Enter Password">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">เข้าสู่ระบบ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
    // Show the Modal on load
    $("#myModal").modal({backdrop: false});
    $("#myModal").modal("show");
    
});
    </script>