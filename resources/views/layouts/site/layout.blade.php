<?php makeAnalyze(); ?><!DOCTYPE html PUBLIC
        "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="fa-IR">
<head>
    @section('head')

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>



        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='{{url("template/site/styles/bootstrap.min.css")}}' rel='stylesheet' type='text/css'>
        <link href="{{url("template/site/css/global.css")}}" rel="stylesheet" type="text/css"/>
        <link href='{{url("template/site/styles/animate.css")}}' rel='stylesheet' type='text/css'>
        <link href='{{url("template/site/styles/custom.css")}}' rel='stylesheet' type='text/css'>
        <link href='{{url("template/site/styles/custom-media.css")}}' rel='stylesheet' type='text/css'>
        <link href="{{asset('template/adminto/assets/css/fontawesome-all.min.css')}}" rel="stylesheet" type="text/css"/>

        <script type="text/javascript" src="{{url("template/site/js/jquery.min.js")}}"></script>
        <script type="text/javascript" src="{{url("template/site/js/jquery-ui-1.9.1.custom.min.js")}}"></script>
        <script src='{{url("template/site/styles/bootstrap.min.js")}}' type='text/javascript'></script>
        <script src='{{url("template/site/styles/jquery.nicescroll.js")}}' type='text/javascript'></script>
        <link href="{{url("template/site/css/evolutionscript/jquery-ui-1.9.2.custom.css")}}" rel="stylesheet">

        <link rel="icon" href="{{url("favicon.png")}}" type="image/png"/>

        <script src="{{asset('template/adminto/assets/js/jquery.min.js')}}"></script>
    @show

    <meta name="msvalidate.01" content="D592FB011C73322E0297FA7BB7DD7B01"/>
</head>

<body dir="rtl">
<style>
    .navbar-nav > li {
        float: right !important;
    }
</style>
<div class="headerTopContainer">
    <div class="container">
        <div class="  row">
            <div class="  col-lg-3 col-md-3 col-xs-5  " style="margin-top: 10px">
                {{--<a href="tel://09126145705" class="login"> تماس باپشتیبان <img--}}
                {{--src="{{url("template/site/styles/images/call2.png")}}" width="10px"/></a>--}}
                <a class="btn-primary btn   btn-md  " href="{{url('learning')}}">آموزش کسب درآمد<span class="hidden-xs"> و ثبت تبلیغ</span></a>
            </div>

            <div class="col-lg-9 col-md-9 col-xs-7 btn_logreg">

                @if(auth('user')->check())
                    <a href="{{url('user/home')}}" class="btn btn-success btn-xs">
                        <img src="profile.png" width="25px" class="img-circle"/>
                        رفتن به حساب </a>

                    <a href="{{url('user/getLogout')}}" class="btn btn-danger btn-xs">
                        خروج </a>

                @else

                    <a href="{{url('user/login')}}" class="login btn btn-xs">ورود</a>
                    <span></span>
                    <a href="{{url('user/register')}}" class="register btn btn-xs"> عضویت </a>
                @endif


            </div>

        </div><!-- end headerTopInner -->
    </div><!-- end container-->
</div><!-- end headerTopContainer -->

<div class="fullsite">
    <div class="wrapper">
        <div id="header">

            @include('layouts.site.navbar')

            @yield('content')
        </div> <!-- end footerContainer -->

    </div>
</div>
@include('layouts.site.footer')
<script type="text/javascript" src="https://www.adclicki.ir/js/pgk.js"></script>
<a id="demo" href="https://www.adclicki.ir/user/pgk/5">-</a>
</body>
</html>


