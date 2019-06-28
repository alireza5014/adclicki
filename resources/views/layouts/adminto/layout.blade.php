<?php (auth('admin')->check()) ? $guard = 'admin' : $guard = 'user' ?>

        <!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    @section('header')
        {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>--}}


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
        {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}
        <script src="{{asset('template/adminto/assets/js/jquery.min.js')}}"></script>
        <script src="{{asset('template/adminto/assets/js/croppie.js')}}"></script>

        {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>--}}


        {{--<script src="{{asset('template/adminto/assets/js/jquery.min.js')}}"></script>--}}


        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


        <link rel="shortcut icon" href="{{url('favicon.png')}}">



        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="{{url('template/adminto/assets/plugins/morris/morris.css')}}">

        <!-- App css -->
        <link href="{{asset('template/adminto/assets/css/bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('template/adminto/assets/css/core.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('template/adminto/assets/css/components.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('template/adminto/assets/css/fontawesome-all.min.css')}}" rel="stylesheet" type="text/css"/>

        <link href="{{asset('template/adminto/assets/css/icons.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('template/adminto/assets/css/pages.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('template/adminto/assets/css/menu.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('template/adminto/assets/css/responsive.css')}}" rel="stylesheet" type="text/css"/>

        <!-- HTML5 Shiv and Respond.js')}} IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js')}} doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->



        <script src="{{asset('template/adminto/assets/js/modernizr.min.js')}}"></script>

        <link href="{{asset('template/adminto/assets/plugins/custombox/dist/custombox.min.css')}}" rel="stylesheet">
        <link href="{{asset('css/sweetalert2.min.css')}}" rel="stylesheet">



    @show

</head>


<body class="fixed-left">

<div id="loader" style="display: none;position: absolute;top:20px;left:20px;z-index: 9999;"
     class="fa fa-spinner fa-spin fa-2x"></div>

<!-- Begin page -->


<div id="wrapper"
        class=""
>

    <!-- Top Bar Start -->
    <div class="topbar">

        <!-- LOGO -->

        <!-- Button mobile view to collapse sidebar menu -->
        <div class="navbar navbar-default" role="navigation">
            <div class="container">
                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <button class="button-menu-mobile open-left">
                            <i class="zmdi zmdi-menu"></i>
                        </button>
                    </li>
                @if($guard=='user')

                    <!-- Page title -->


                        <li>
                            {{--<h4 class="page-title">پیشخوان</h4>--}}
                            <a style="font-size: 10px;line-height: .1" href="tel://09126145705" class="login">09126145705
                                <br/> تماس با پشتیبانی <img
                                        src="{{url("template/site/styles/images/call2.png")}}"/></a>
                        </li>
                        <li>
                            {{--<h4 class="page-title">پیشخوان</h4>--}}
                            <a href="https://t.me/adclicki_bot?start=code_{{base64_encode(getUserId())}}"
                               target="_blank" class="login"> <img src="{{url("telegram.png")}}"/></a>
                        </li>
                </ul>


                <?php
                $messages = \App\Model\Message::whereHas('users', function ($q) {
                    return $q->where('users.id', getUserId());
                })
                    ->where('is_public', 0)
                    ->orderBy('id', 'DESC')
                    ->get();

                $pub_messages = \App\Model\Message::where('is_public', 1)->get();
                foreach ($pub_messages as $message) {
                    $messages[] = $message;
                }
                ?>
                <ul class="nav navbar-nav navbar-right">

                    @if(getActivityType()==1 || getActivityType()==2)
                        <li class="hidden-xs m-t-20 m-r-5">

                            <a href="{{route('user.payments.buy.click')}}" class="btn btn-danger btn-xs"> خرید کلیک</a>

                        </li>

                        <li class="hidden-xs m-t-20 m-r-5">

                            <a href="{{route('user.ads.clicki.new')}}" class="btn btn-primary btn-xs">ثبت تبلیغ کلیکی
                                جدبد</a>

                        </li>
                        <li class="hidden-xs m-t-20 m-r-15">

                            <a href="{{route('user.ads.google_search.new')}}" class="btn btn-success btn-xs">ثبت تبلیغ جستجو
                                گوگل جدبد</a>

                        </li>
                    @endif
                    <li>
                        <!-- Notification -->
                        <div class="notification-box ">
                            <ul class="list-inline m-b-0 ">
                                <li>
                                    <a href="javascript:void(0);" class="right-bar-toggle">
                                        <i class="zmdi zmdi-notifications-none"></i>
                                        <div class="noti-dot">
                                            @if(sizeof($messages)>0)
                                                <span class="dot"></span>
                                                <span class="pulse"></span>
                                            @endif
                                        </div>
                                    </a>

                                </li>


                            </ul>
                        </div>
                        <!-- End Notification bar -->
                    </li>
                </ul>


                <!-- Right Sidebar -->
                <div class="side-bar right-bar">
                    <a href="javascript:void(0);" class="right-bar-toggle">
                        <i class="zmdi zmdi-close-circle-o"></i>
                    </a>
                    <h4 class="">پیام ها</h4>
                    <div class="notification-list nicescroll">
                        <ul class="list-group list-no-border user-list">

                            @foreach($messages as $message)
                                <li class="list-group-item">
                                    <a href="{{url('user/message')}}" class="user-list-item">
                                        <div class="avatar">
                                            <img src="{{url($message->image_path)}}"
                                                 alt="">
                                        </div>
                                        <div class="user-desc">
                                            <span class="name">  {{$message->title}}</span>
                                            <span class="desc">   {{substr($message->description,0,20)}}    </span>
                                            <span class="time">{{$message->created_at}}
                                                <code>{{is_public($message->is_public)}}</code></span>

                                        </div>

                                    </a>
                                </li>

                            @endforeach

                        </ul>
                    </div>
                </div>
                <!-- /Right-bar -->
                @endif

                </ul>

            </div><!-- end container -->
        </div><!-- end navbar -->
    </div>
    <!-- Top Bar End -->


    <!-- ========== Left Sidebar Start ========== -->
    <div class="left side-menu">
        <div class="sidebar-inner slimscrollleft">


            <!--- Sidemenu -->
        @include('layouts.adminto.sidebar_menu')
        <!-- Sidebar -->
            <div class="clearfix"></div>

        </div>

    </div>
    <!-- Left Sidebar End -->


    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->

        <div class="content">

            <div class="container">

                @include('flash_message')

                @if($guard=='user')
                    <div class="text-center card-box-1 m-t-10">
                        <ul class="list-inline">
                            @if(getActivityType()==0 || getActivityType()==2)

                                <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-danger">

                                    مجموع دریافتی ها :

                                    <span class="  text-dark  ">{{convert_to_digit(number_format(getTotalDaryafti()))}}</span>

                                    تومان
                                </li>
                                <code class="">-</code>

                                <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-success">

                                    سهم شما از درآمد زیر مجموعه ها :

                                    <span class="  text-dark  ">{{convert_to_digit(number_format(getRefererIncome(getUserId())))}}</span>

                                    تومان
                                </li>

                                <code class="">+</code>


                                <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-success">

                                    درآمد شما :

                                    <span class="  text-dark  ">{{convert_to_digit(number_format(getTotalIncome(getUserId())))}}</span>

                                    تومان
                                </li>



                                <code class="">=</code>

                                <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-info">

                                    موجودی کل :

                                    <span class="text-dark">{{convert_to_digit(number_format(getTotalBalance(getUserId())))}}</span>
                                    تومان
                                </li>


                            @endif



                            @if(getActivityType()==1 || getActivityType()==2)
                                <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-warning">

                                    موجودی کلیک های شما :

                                    <span class="  text-dark  ">{{convert_to_digit(getTotalClick())}}</span>

                                    تومان
                                </li>


                            @endif

                        </ul>
                    </div>

                @endif
                @yield('content')
            </div>
        </div>
        <div class="clearfix"></div>
        @include('layouts.adminto.footer')

    </div>


    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->


</div>
<!-- END wrapper -->

<script>
    w = $(window).width();
    if(w<480){
        $('#wrapper').addClass('forced enlarged')
    }
</script>
@yield('footer')

@section('js')

    <script src="{{url('template/adminto/assets/js/jquery.barrating.js')}}"></script>
    <script src="{{url('template/adminto/assets/js/examples.js')}}"></script>
    <!-- jQuery  -->
    {{--<script src="{{asset('template/adminto/assets/js/jquery.min.js')}}"></script>--}}
    <script src="{{asset('template/adminto/assets/js/bootstrap-rtl.min.js')}}"></script>


    <script src="{{asset('template/adminto/assets/js/detect.js')}}"></script>
    <script src="{{asset('template/adminto/assets/js/fastclick.js')}}"></script>
    <script src="{{asset('template/adminto/assets/js/jquery.blockUI.js')}}"></script>
    <script src="{{asset('template/adminto/assets/js/waves.js')}}"></script>
    <script src="{{asset('template/adminto/assets/js/jquery.nicescroll.js')}}"></script>
    <script src="{{asset('template/adminto/assets/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('template/adminto/assets/js/jquery.scrollTo.min.js')}}"></script>

    <!-- KNOB JS -->

    <script src="{{asset('template/adminto/assets/plugins/jquery-knob/jquery.knob.js')}}"></script>

    <!--Morris Chart-->
    <script src="{{asset('template/adminto/assets/plugins/morris/morris.min.js')}}"></script>
    <script src="{{asset('template/adminto/assets/plugins/raphael/raphael-min.js')}}"></script>
    <script src="{{asset('template/adminto/assets/js/jquery.core.js')}}"></script>
    <script src="{{asset('template/adminto/assets/js/jquery.app.js')}}"></script>
    <script src="{{asset('template/adminto/assets/plugins/custombox/dist/custombox.min.js')}}"></script>
    <script src="{{asset('template/adminto/assets/plugins/custombox/dist/legacy.min.js')}}"></script>

    {{--<script src="{{asset('template/adminto/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script>--}}

@show


</body>
</html>