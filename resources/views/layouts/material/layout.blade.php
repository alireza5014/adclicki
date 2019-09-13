<?php

if (auth('admin')->check()) {
    $sidebar_menu = 'layouts.material.sidebar_menu.admin';
    $guard = 'admin';
} else {
    $guard = 'user';
    $sidebar_menu = 'layouts.material.sidebar_menu.user';
}

$path = url('template/material');
?>

        <!DOCTYPE html>
<html lang="en">
<head>
    @section('header')

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Vendor styles -->
        <link rel="stylesheet" href="{{$path}}/css/material-design-iconic-font.min.css">
        <link rel="stylesheet" href="{{$path}}/css/animate.min.css">
        <link rel="stylesheet" href="{{$path}}/vendors/bower_components/jquery.scrollbar/jquery.scrollbar.css">
        <link rel="stylesheet" href="{{$path}}/vendors/bower_components/fullcalendar/dist/fullcalendar.min.css">

        <!-- App styles -->
        <link rel="stylesheet" href="{{$path}}/css/app.min.css">
        <link href="{{$path}}/css/custom.css" rel="stylesheet"/>

        <script src="{{$path}}/vendors/bower_components/jquery/dist/jquery.min.js"></script>
        <link rel="stylesheet" href="{{$path}}/vendors/bower_components/select2/dist/css/select2.min.css">

    @show
</head>

<body data-ma-theme="blue-grey">
<style>

    .form-group--float .form-control ~ label {

        bottom: 2.65rem !important;

    }
    .header{
        height: 35px !important;
    }

    .sidebar {

        padding: 45px 2rem .5rem !important;

    }

    @media (min-width: 1200px) {

        .content:not(.content--boxed):not(.content--full) {
            padding: 45px 270px 0 30px;
        }
    }

    @media (max-width: 1199px) and (min-width: 576px) {
        .content:not(.content--boxed):not(.content--full) {
            padding: 45px 30px 0 !important;
        }
    }

    .quick-stats__item {
        padding: 0.5rem 0.5rem 0.45rem !important;

        margin-bottom: 10px !important;

    }
</style>
<main class="main">
    <div class="page-loader">
        <div class="page-loader__spinner">
            <svg viewBox="25 25 50 50">
                <circle cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
            </svg>
        </div>
    </div>

    <header class="header">
        <div class="navigation-trigger hidden-xl-up" data-ma-action="aside-open" data-ma-target=".sidebar">
            <div class="navigation-trigger__inner">
                <i class="navigation-trigger__line"></i>
                <i class="navigation-trigger__line"></i>
                <i class="navigation-trigger__line"></i>
            </div>
        </div>

        <div class="header__logo hidden-sm-down">
            <h1><a href="">AdClicki</a></h1>
        </div>



        <?php
        $messages = \App\Model\Message::whereHas('users', function ($q) use ($guard) {
            return $q->where('users.id', getUserId($guard));
        })
            ->where('is_public', 0)
            ->orderBy('id', 'DESC')
            ->get();

        $pub_messages = \App\Model\Message::where('is_public', 1)->get();
        foreach ($pub_messages as $message) {
            $messages[] = $message;
        }
        ?>
        <ul class="top-nav">
            {{--<li class="hidden-xl-up"><a href="" data-ma-action="search-open"><i class="zmdi zmdi-search"></i></a>--}}
            {{--</li>--}}

            <li class="dropdown">
                <a href="" data-toggle="dropdown" class="btn-warning">
                    کسب درآمد
                </a>
                <div class="dropdown-menu dropdown-menu-left " style="    width: 250px;
    top: 30px;">
                    <div class="listview listview--hover">


                        <a href="{{route('user.ads.site_list')}}" class="view-more">کسب درآمد از طریق کلیک
                            <span class="badge badge-pill badge-danger ">    {{getTodayUnClickedLink(getUserId($guard),0)}}</span>
                        </a>
                        <a href="{{route('user.ads.search_list',['engine'=>'google'])}}" class="view-more">کسب درآمد از
                            سرچ گوگل
                            <span class="badge badge-pill badge-danger ">    {{getTodayUnClickedLink(getUserId($guard),1)}}</span>
                        </a>
                        <a href="{{route('user.ads.search_list',['engine'=>'bing'])}}" class="view-more">کسب درآمد از
                            سرچ بینگ
                            <span class="badge badge-pill badge-danger ">    {{getTodayUnClickedLink(getUserId($guard),2)}}</span>
                        </a>
                        <a href="{{route('user.ads.search_list',['engine'=>'yahoo'])}}" class="view-more">کسب درآمد از
                            سرچ یاهو
                            <span class="badge badge-pill badge-danger ">    {{getTodayUnClickedLink(getUserId($guard),3)}}</span>
                        </a>
                        <a href="{{route('user.ads.search_list',['engine'=>'aparat'])}}" class="view-more">کسب درآمد از
                            سرچ آپارات
                            <span class="badge badge-pill badge-danger ">    {{getTodayUnClickedLink(getUserId($guard),4)}}</span>
                        </a>

                        <a href="" class="view-more">
                            کسب درآمد از اینستاگرام
                            <span class="badge badge-pill badge-danger ">    بزودی</span>
                        </a>


                    </div>
                </div>
            </li>
            <li class="">
                <a href="{{url('user/payments/buy/click')}}" class="btn btn-primary">
                    خرید کلیک
                </a>
            </li>


            <li class="dropdown">
                <a href="" data-toggle="dropdown" class="btn-success">
                    ثبت تبلیغ
                </a>
                <div class="dropdown-menu dropdown-menu-left " style="    width: 250px;
    top: 30px;">
                    <div class="listview listview--hover">


                        <a href="{{route('user.ads.clicki.new')}}" class="view-more">ثبت تبلیغ کلیکی</a>
                        <a href="{{route('user.ads.google_search.new')}}" class="view-more">ثبت تبلیغ جستجو(گوگل - بینگ
                            - یاهو)</a>
                        <a href="" class="view-more">ثبت تبلیغ پاپ آپ (بزودی)</a>

                    </div>
                </div>
            </li>


            <li class="dropdown">
                <a href="" data-toggle="dropdown" class="btn-danger">
                    لیست تبلیغات
                </a>
                <div class="dropdown-menu dropdown-menu-left  " style="    width: 250px;
    top: 30px;">
                    <div class="listview listview--hover">


                        <a href="{{route('user.ads.clicki.list')}}" class="view-more">لیست تبلیغات کلیکی</a>
                        <a href="{{route('user.ads.google_search.list')}}" class="view-more">لیست تبلیغات جستجو(گوگل -
                            بینگ - یاهو)</a>
                        <a href="" class="view-more">لیست تبلیغات پاپ آپ (بزودی)</a>

                    </div>
                </div>
            </li>


            <li class="dropdown">
                <a href="" data-toggle="dropdown"><i class="zmdi zmdi-email"></i></a>
                <div class="dropdown-menu dropdown-menu-left dropdown-menu--block">
                    <div class="listview listview--hover">
                        <div class="listview__header">
                            پیام ها

                            <div class="actions">
                                <a href="#" class="actions__item zmdi zmdi-plus"></a>
                            </div>
                        </div>

                        @foreach($messages as $message)

                            <a href="#" class="listview__item">
                                <img src="{{url($message->image_path)}}" class="listview__img" alt="">

                                <div class="listview__content">
                                    <div class="listview__heading">
                                        {{$message->title}}
                                        <small>{{$message->created_at}}</small>
                                    </div>
                                    <p>{{substr($message->description,0,20)}}</p>
                                </div>
                            </a>
                        @endforeach


                        <a href="{{url('user/message')}}" class="view-more">مشاهده تمام پیام ها</a>
                    </div>
                </div>
            </li>


            {{--<li class="dropdown top-nav__notifications">--}}
            {{--<a href="" data-toggle="dropdown" class="top-nav__notify">--}}
            {{--<i class="zmdi zmdi-notifications"></i>--}}
            {{--</a>--}}
            {{--<div class="dropdown-menu dropdown-menu-left dropdown-menu--block">--}}
            {{--<div class="listview listview--hover">--}}
            {{--<div class="listview__header">--}}
            {{--اطلاعیه--}}

            {{--<div class="actions">--}}
            {{--<a href="" class="actions__item zmdi zmdi-check-all"--}}
            {{--data-ma-action="notifications-clear"></a>--}}
            {{--</div>--}}
            {{--</div>--}}

            {{--<div class="listview__scroll scrollbar-inner">--}}
            {{--<a href="" class="listview__item">--}}
            {{--<img src="demo/img/profile-pics/1.jpg" class="listview__img" alt="">--}}

            {{--<div class="listview__content">--}}
            {{--<div class="listview__heading">David Belle</div>--}}
            {{--<p>تقدیر اجتماعی است که به طور مستقل و ماتریس می شود</p>--}}
            {{--</div>--}}
            {{--</a>--}}

            {{--<a href="" class="listview__item">--}}
            {{--<img src="demo/img/profile-pics/2.jpg" class="listview__img" alt="">--}}

            {{--<div class="listview__content">--}}
            {{--<div class="listview__heading">حسین حسینی</div>--}}
            {{--<p> قطر اما در حال حاضر عنصر درد، و یا آن را زشت</p>--}}
            {{--</div>--}}
            {{--</a>--}}

            {{--<a href="" class="listview__item">--}}
            {{--<img src="demo/img/profile-pics/3.jpg" class="listview__img" alt="">--}}

            {{--<div class="listview__content">--}}
            {{--<div class="listview__heading">اکبر اکبری</div>--}}
            {{--<p>یک قایق قبل و در اندوه فوتبال در آسانسور از پول و یا تبلیغات نشستن</p>--}}
            {{--</div>--}}
            {{--</a>--}}

            {{--<a href="" class="listview__item">--}}
            {{--<img src="demo/img/profile-pics/4.jpg" class="listview__img" alt="">--}}

            {{--<div class="listview__content">--}}
            {{--<div class="listview__heading">محمد محمدی</div>--}}
            {{--<p>برای برای من آنجا بزرگترین زندگی است، اما در حال حاضر بسیاری این هست ارزش گوجه--}}
            {{--فرنگی دشوار</p>--}}
            {{--</div>--}}
            {{--</a>--}}

            {{--<a href="" class="listview__item">--}}
            {{--<img src="demo/img/profile-pics/5.jpg" class="listview__img" alt="">--}}

            {{--<div class="listview__content">--}}
            {{--<div class="listview__heading">رضا رضایی</div>--}}
            {{--<p>من راحتی مایکروویو بادام زمینی به گلو می شود. زمانی که ممکن است محفوظ است، حتی--}}
            {{--قبل از تامین مالی املاک و مستغلات</p>--}}
            {{--</div>--}}
            {{--</a>--}}

            {{--<a href="" class="listview__item">--}}
            {{--<img src="demo/img/profile-pics/1.jpg" class="listview__img" alt="">--}}

            {{--<div class="listview__content">--}}
            {{--<div class="listview__heading">David Belle</div>--}}
            {{--<p>تقدیر اجتماعی است که به طور مستقل و ماتریس می شود</p>--}}
            {{--</div>--}}
            {{--</a>--}}

            {{--<a href="" class="listview__item">--}}
            {{--<img src="demo/img/profile-pics/2.jpg" class="listview__img" alt="">--}}

            {{--<div class="listview__content">--}}
            {{--<div class="listview__heading">حسین حسینی</div>--}}
            {{--<p> قطر اما در حال حاضر عنصر درد، و یا آن را زشت</p>--}}
            {{--</div>--}}
            {{--</a>--}}

            {{--<a href="" class="listview__item">--}}
            {{--<img src="demo/img/profile-pics/3.jpg" class="listview__img" alt="">--}}

            {{--<div class="listview__content">--}}
            {{--<div class="listview__heading">اکبر اکبری</div>--}}
            {{--<p>یک قایق قبل و در اندوه فوتبال در آسانسور از پول و یا تبلیغات نشستن</p>--}}
            {{--</div>--}}
            {{--</a>--}}
            {{--</div>--}}

            {{--<div class="p-1"></div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</li>--}}

            {{--<li class="dropdown hidden-xs-down">--}}
            {{--<a href="" data-toggle="dropdown"><i class="zmdi zmdi-check-circle"></i></a>--}}

            {{--<div class="dropdown-menu dropdown-menu-left dropdown-menu--block" role="menu">--}}
            {{--<div class="listview listview--hover">--}}
            {{--<div class="listview__header"> وضایف</div>--}}

            {{--<a href="" class="listview__item">--}}
            {{--<div class="listview__content">--}}
            {{--<div class="listview__heading"> گزارش آخر هفته</div>--}}

            {{--<div class="progress">--}}
            {{--<div class="progress-bar" style="width: 75%" aria-valuenow="75" aria-valuemin="0"--}}
            {{--aria-valuemax="100"></div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</a>--}}

            {{--<a href="" class="listview__item">--}}
            {{--<div class="listview__content">--}}
            {{--<div class="listview__heading"> بررسی وضایف محوله</div>--}}

            {{--<div class="progress">--}}
            {{--<div class="progress-bar bg-warning" style="width: 43%" aria-valuenow="43"--}}
            {{--aria-valuemin="0" aria-valuemax="100"></div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</a>--}}

            {{--<a href="" class="listview__item">--}}
            {{--<div class="listview__content">--}}
            {{--<div class="listview__heading"> شبکه های اجتماعی</div>--}}

            {{--<div class="progress">--}}
            {{--<div class="progress-bar bg-success" style="width: 20%" aria-valuenow="20"--}}
            {{--aria-valuemin="0" aria-valuemax="100"></div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</a>--}}

            {{--<a href="" class="listview__item">--}}
            {{--<div class="listview__content">--}}
            {{--<div class="listview__heading"> ادمین بوت استرپ</div>--}}

            {{--<div class="progress">--}}
            {{--<div class="progress-bar bg-info" style="width: 60%" aria-valuenow="60"--}}
            {{--aria-valuemin="0" aria-valuemax="100"></div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</a>--}}

            {{--<a href="" class="listview__item">--}}
            {{--<div class="listview__content">--}}
            {{--<div class="listview__heading">Youtube Client App</div>--}}

            {{--<div class="progress">--}}
            {{--<div class="progress-bar bg-danger" style="width: 80%" aria-valuenow="80"--}}
            {{--aria-valuemin="0" aria-valuemax="100"></div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</a>--}}

            {{--<a href="" class="view-more"> مشاهده تمام وظایف</a>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</li>--}}

            {{--<li class="dropdown hidden-xs-down">--}}
            {{--<a href="" data-toggle="dropdown"><i class="zmdi zmdi-apps"></i></a>--}}

            {{--<div class="dropdown-menu dropdown-menu-left dropdown-menu--block" role="menu">--}}
            {{--<div class="row app-shortcuts">--}}
            {{--<a class="col-4 app-shortcuts__item" href="">--}}
            {{--<i class="zmdi zmdi-calendar bg-red"></i>--}}
            {{--<small class=""> تقویم</small>--}}
            {{--</a>--}}
            {{--<a class="col-4 app-shortcuts__item" href="">--}}
            {{--<i class="zmdi zmdi-file-text bg-blue"></i>--}}
            {{--<small class=""> فایل ها</small>--}}
            {{--</a>--}}
            {{--<a class="col-4 app-shortcuts__item" href="">--}}
            {{--<i class="zmdi zmdi-email bg-teal"></i>--}}
            {{--<small class=""> ایمیل ها</small>--}}
            {{--</a>--}}
            {{--<a class="col-4 app-shortcuts__item" href="">--}}
            {{--<i class="zmdi zmdi-trending-up bg-blue-grey"></i>--}}
            {{--<small class=""> گزارش ها</small>--}}
            {{--</a>--}}
            {{--<a class="col-4 app-shortcuts__item" href="">--}}
            {{--<i class="zmdi zmdi-view-headline bg-orange"></i>--}}
            {{--<small class=""> خبرها</small>--}}
            {{--</a>--}}
            {{--<a class="col-4 app-shortcuts__item" href="">--}}
            {{--<i class="zmdi zmdi-image bg-light-green"></i>--}}
            {{--<small class=""> گالری</small>--}}
            {{--</a>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</li>--}}

            {{--<li class="dropdown hidden-xs-down  ">--}}
            {{--<a href="" data-toggle="dropdown"><i class="zmdi zmdi-more-vert"></i></a>--}}

            {{--<div class="dropdown-menu dropdown-menu-left">--}}
            {{--<div class="dropdown-item theme-switch">--}}
            {{--تغییر تم--}}

            {{--<div class="btn-group btn-group--colors mt-2" data-toggle="buttons">--}}
            {{--<label class="btn bg-green active"><input type="radio" value="green" autocomplete="off"--}}
            {{--checked></label>--}}
            {{--<label class="btn bg-blue"><input type="radio" value="blue" autocomplete="off"></label>--}}
            {{--<label class="btn bg-red"><input type="radio" value="red" autocomplete="off"></label>--}}
            {{--<label class="btn bg-orange"><input type="radio" value="orange" autocomplete="off"></label>--}}
            {{--<label class="btn bg-teal"><input type="radio" value="teal" autocomplete="off"></label>--}}

            {{--<br>--}}

            {{--<label class="btn bg-cyan"><input type="radio" value="cyan" autocomplete="off"></label>--}}
            {{--<label class="btn bg-blue-grey"><input type="radio" value="blue-grey"--}}
            {{--autocomplete="off"></label>--}}
            {{--<label class="btn bg-purple"><input type="radio" value="purple" autocomplete="off"></label>--}}
            {{--<label class="btn bg-indigo"><input type="radio" value="indigo" autocomplete="off"></label>--}}
            {{--<label class="btn bg-lime"><input type="radio" value="lime" autocomplete="off"></label>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<a href="" class="dropdown-item"> تمام صفحه</a>--}}
            {{--<a href="" class="dropdown-item"> پاک کردن حافظه داخلی</a>--}}
            {{--</div>--}}
            {{--</li>--}}

            {{--<li class="hidden-xs-down">--}}
            {{--<a href="" data-ma-action="aside-open" data-ma-target=".chat" class="top-nav__notify">--}}
            {{--<i class="zmdi zmdi-comment-alt-text"></i>--}}
            {{--</a>--}}
            {{--</li>--}}
        </ul>
    </header>
    <aside class="sidebar">

        @include($sidebar_menu)

    </aside>

    <aside class="chat">


        @include('layouts.material.chat')
    </aside>

    <section class="content">


        @if($guard=='user')

            <div class="row group hidden-xs-down">
                <a class="col-sm-6 col-md-3">
                    <div class="quick-stats__item bg-success">

                        <div class="quick-stats__info">
                            <h6 class="color-white">{{convert_to_digit(number_format(getTotalBalance(getUserId())))}} <span>تومان</span></h6>
                            <small style="font-size: 12px"> موجودی کل</small>
                        </div>

                    </div>
                </a>

                <a class="col-sm-6 col-md-3">
                    <div class="quick-stats__item bg-success">

                        <div class="quick-stats__info">
                            <h6 class="color-white">{{convert_to_digit(number_format(getTotalWebsite()))}} <span>تومان</span></h6>
                            <small style="font-size: 12px">   مجموع درآمد وب سایت ها</small>
                        </div>

                    </div>
                </a>

                <a class="col-sm-6 col-md-3">

                    <div class="quick-stats__item bg-info">

                        <div class="quick-stats__info">
                            <h6 class="color-white">{{convert_to_digit(number_format(getTotalDaryafti()))}} <span>تومان</span></h6>
                            <small style="font-size: 12px"> مجموع دریافتی ها</small>
                        </div>

                    </div>
                </a>

                <a class="col-sm-6 col-md-3">

                    <div class="quick-stats__item bg-primary">

                        <div class="quick-stats__info">
                            <h6 class="color-white">{{convert_to_digit(number_format(getTotalIncome(getUserId())))}} <span>تومان</span></h6>
                            <small style="font-size: 12px"> درآمد شما از کلیک و جستجوی گوگل(کل) </small>
                        </div>

                    </div>
                </a>


                <a class="col-sm-6 col-md-3">

                    <div class="quick-stats__item bg-primary">

                        <div class="quick-stats__info">
                            <h6 class="color-white">{{convert_to_digit(number_format(getTotalIncome(getUserId(),'today')))}} <span>تومان</span></h6>
                            <small style="font-size: 12px"> درآمد شما از کلیک و جستجوی گوگل(امروز) </small>
                        </div>

                    </div>
                </a>
                <a class="col-sm-6 col-md-3">
                    <div class="quick-stats__item bg-warning">

                        <div class="quick-stats__info">
                            <h6 class="color-white">{{convert_to_digit(getTotalClick())}} <span>عدد</span></h6>
                            <small style="font-size: 12px"> موجودی کلیک ها</small>
                        </div>

                    </div>
                </a>

                <a class="col-sm-6 col-md-3">
                    <div class="quick-stats__item bg-grey">

                        <div class="quick-stats__info">
                            <h6 class="color-white">{{convert_to_digit(getTotalClick()/5)}} <span>عدد</span></h6>
                            <small style="font-size: 12px"> موجودی جستجو ها</small>
                        </div>

                    </div>
                </a>

                <div class="col-sm-6 col-md-3">
                    <div class="quick-stats__item bg-blue-grey">

                        <div class="quick-stats__info">
                            <h6 class="color-white">{{convert_to_digit(number_format(getRefererIncome(getUserId())+getSubCategoryIncome(getUserId())))}} <span>تومان</span></h6>
                            <small style="font-size: 12px"> سهم شما از درآمد زیر مجموعه ها</small>
                        </div>

                    </div>
                </div>


            </div>



        @endif
        @yield('content')

        @include('layouts.material.footer')

    </section>

</main>
<script>
    function copyToClipboard(elementId, type = 'select',title="کپی شد") {


        var aux = document.createElement("input");


        switch (type) {
            case 'select':
                aux.setAttribute("value", $("#" + elementId + " option:selected").text());
                break;

            case 'input':
                aux.setAttribute("value", $("#" + elementId).val());
                break;

            case 'element':


                aux.setAttribute("value", $("#" + elementId).text());
                $("#" + elementId).css("background-color", "yellow");
                break;
        }

        document.body.appendChild(aux);

        aux.select();

        document.execCommand("copy");


        document.body.removeChild(aux);


    }

</script>


{{--<script src="//code.tidio.co/anzdmo7lio9uih04o0xjh6wrzcmhjsee.js"></script>--}}

<!-- Javascript -->
<!-- Vendors -->
{{--<script src="{{$path}}/vendors/bower_components/jquery/dist/jquery.min.js"></script>--}}
<script src="{{$path}}/vendors/bower_components/tether/dist/js/tether.min.js"></script>
<script src="{{$path}}/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="{{$path}}/vendors/bower_components/Waves/dist/waves.min.js"></script>
<script src="{{$path}}/vendors/bower_components/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="{{$path}}/vendors/bower_components/jquery-scrollLock/jquery-scrollLock.min.js"></script>
<script src="{{$path}}/vendors/bower_components/Waves/dist/waves.min.js"></script>

<script src="{{$path}}/vendors/bower_components/flot/jquery.flot.js"></script>
<script src="{{$path}}/vendors/bower_components/flot/jquery.flot.resize.js"></script>
<script src="{{$path}}/vendors/bower_components/flot.curvedlines/curvedLines.js"></script>
<script src="{{$path}}/vendors/bower_components/jqvmap/dist/jquery.vmap.min.js"></script>
<script src="{{$path}}/vendors/bower_components/jqvmap/dist/maps/jquery.vmap.world.js"></script>
<script src="{{$path}}/vendors/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
<script src="{{$path}}/vendors/bower_components/salvattore/dist/salvattore.min.js"></script>
<script src="{{$path}}/vendors/jquery.sparkline/jquery.sparkline.min.js"></script>
<script src="{{$path}}/vendors/bower_components/moment/min/moment.min.js"></script>
<script src="{{$path}}/vendors/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>

<!-- Charts and maps-->
<script src="{{$path}}/demo/js/flot-charts/curved-line.js"></script>
<script src="{{$path}}/demo/js/flot-charts/line.js"></script>
<script src="{{$path}}/demo/js/flot-charts/chart-tooltips.js"></script>
<script src="{{$path}}/demo/js/other-charts.js"></script>
<script src="{{$path}}/demo/js/jqvmap.js"></script>

<!-- App functions and actions -->
<script src="{{$path}}/js/app.min.js"></script>

<script src="{{$path}}/vendors/bower_components/select2/dist/js/select2.full.min.js"></script>
 @include('flash_message')
 </body>
</html>