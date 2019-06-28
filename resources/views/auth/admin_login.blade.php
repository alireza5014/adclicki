<!DOCTYPE html>
<?php $path = url('template/material');?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Vendor styles -->
    <link rel="stylesheet" href="{{$path}}/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="{{$path}}/css/animate.min.css">

    <!-- App styles -->
    <link rel="stylesheet" href="{{$path}}/css/app.min.css"><link href="css/custom.css" rel="stylesheet">
</head>

<body data-ma-theme="green">

<div class="login">

    <!-- Login -->
    <div class="login__block active" id="l-login">
        <div class="login__block__header">
            <i class="zmdi zmdi-account-circle"></i>
            ورود به حساب کاربری


        </div>
        <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.login.submit') }}">
            {{ csrf_field() }}

            <div class="login__block__body">
                <div class="form-group form-group--float form-group--centered">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                    >
                    <label> ایمیل</label>
                    <i class="form-group__bar"></i>
                </div>

                <div class="form-group form-group--float form-group--centered">
                    <input id="password" type="password" class="form-control" name="password"
                    >
                    <label>رمز عبور</label>
                    <i class="form-group__bar"></i>
                </div>

                <button type="submit" class="btn btn--icon login__block__btn waves-effect"><i class="zmdi zmdi-long-arrow-right"></i></button>
            </div>
        </form>

    </div>


</div>


<!-- Javascript -->
<!-- Vendors -->
<script src="{{$path}}/vendors/bower_components/jquery/dist/jquery.min.js"></script>
<script src="{{$path}}/vendors/bower_components/tether/dist/js/tether.min.js"></script>
<script src="{{$path}}/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="{{$path}}/vendors/bower_components/Waves/dist/waves.min.js"></script>

<!-- App functions and actions -->
<script src="{{$path}}/js/app.min.js"></script>
@include('flash_message')

</body></html>

