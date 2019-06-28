
<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="ورود به حساب کاربری اد کلیکی -  تبلیغات کلیکی  ">
    <meta name="description" content="رورود به حساب کاربری اد کلیکی">
    <meta name="author" content="  علیرضا حیدری">

    <!-- App Favicon -->


    <!-- App title -->
    <title> ورود به حساب کاربری اد کلیکی </title>


    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="{{asset('template/adminto/assets/plugins/morris/morris.css')}}">

    <!-- App css -->
    <link href="{{url('template/adminto/assets/css/bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css"/>


    <link href="{{asset('template/adminto/assets/css/core.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('template/adminto/assets/css/components.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('template/adminto/assets/css/icons.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('template/adminto/assets/css/pages.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('template/adminto/assets/css/menu.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('template/adminto/assets/css/responsive.css')}}" rel="stylesheet" type="text/css"/>

    <!-- HTML5 Shiv and Respond.js')}} IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js')}} doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js')}}/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script src="{{url('template/adminto/assets/js/jquery.min.js')}}"></script>

    <![endif]-->

    <script src="{{asset('template/adminto/assets/js/modernizr.min.js')}}"></script>

</head>
<body>


<div class="card-box">
    <div class="container">
        <a href="{{url('')}}" class="logo pull-left">صفحه اصلی</a>
        <a class="pull-right" href="{{url('')}}"><img src="{{url('template/site/styles/images/logo.png')}}"
                                                      height="40px"> </a>
    </div>
    <div class="clearfix"></div>
</div>
<div class="row">


    <div class="col-md-6 col-md-offset-1">
        <div class="card-box">
            <p class="panel-body">

            <h3 href="{{url('')}}" class="logo"><span>   اد<span>کلیکی</span></span></h3>

            <p> اد کلیکی یک وبسایت افزایش بازدید، بهبود رتبه الکسا و بالا بردن ترافیک وبسایت ها با بهترین روش می
                باشد به گونه ای که در بهبود رتبه الکسای سایت ها تاثیر چشم گیری خواهد داشت. تاثیر این روش در یک بازه
                5 تا 14 روزه قابل مشاهده می باشد.
            </p>
            <p>وبسایت اد کلیکی در راستای رسیدن به اهداف خود از دو گروه کاربری بهره می برد،</p>
            <p> گروه اول کاربرانی که به
                کسب درآمد بصورت تضمینی و بدون نیاز به حضور دائمی و با استفاده از یک مرور گر می پردازند. </p>
            <p>گروه دوم
                کاربرانی که جهت افزایش ترافیک وبسایت، کاهش رتبه الکسا و افزایش بازدید وبسایت ها از بازدید های واقعی
                کاربران ما بهره مند می گردند</p>
            </p>
        </div>


        <div class="card-box">
            <h4 class="logo">نیاز به افزایش بازدید سایت دارم</h4>

            <p>کاهش رتبه الکسا و افزایش بازید توسط سیستم هوشمند و کاربران واقعی صد در صد تضمینی .</p>

        </div>

        <div class="card-box">
            <h4 class="logo"> کسب درآمد بصورت تضمین</h4>


            <p>کسب درآمد بصورت تضمینی و بدون نیاز به حضور دائمی و با استفاده از یک مرور گر .</p>
        </div>
    </div>
    <div class="col-md-4">

        <div class="m-t-0 card-box">
            <div class="text-center">
                <h4 class="logo font-bold m-b-0"> ورود به حساب کاربری اد کلیکی</h4>
            </div>
            <div class="panel-body">

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/site/login') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email"
                                       value="{{ old('email') }}"
                                       placeholder="ایمیل خود را وارد کنید">
                                <p id="email_error" class="text-danger"></p>


                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password"
                                       placeholder="گذرواژه خود را وارد کنید">
                                <p id="password_error" class="text-danger"></p>


                            </div>
                        </div>


                        {{--<div class="col-md-6 pull-center">--}}
                        {{--{!! app('captcha')->display() !!}--}}

                        {{--@if ($errors->has('g-recaptcha-response'))--}}
                        {{--<span class="help-block">--}}
                        {{--<strong>{{ $errors->first('g-recaptcha-response') }}</strong>--}}
                        {{--</span>--}}
                        {{--@endif--}}
                        {{--</div>--}}

                        <div class="form-group">

                            <div class="form-group text-center m-t-30">
                                <div class="col-xs-12">
                                    <a id="login_site"
                                       class="btn btn-custom btn-bordred btn-block waves-effect waves-light">
                                        ورود
                                        <i style="display: none" id="loader3" class="fa fa-spinner fa-spin "></i>

                                    </a>
                                </div>
                            </div>


                        </div>


                        {{--<div class="form-group">--}}
                        {{--<div class="form-group text-right m-t-30">--}}
                        {{--<div class="col-xs-12">--}}
                        {{--<a href="{{url('auth/google')}}" class="btn btn-danger btn-bordred btn-block waves-effect waves-light" >--}}
                        {{--<li class="fa fa-google-plus text-right "></li>--}}
                        {{--ورود با حساب کاربری گوگل--}}

                        {{--</a>--}}
                        {{--</div>--}}
                        {{--</div>--}}


                    </form>


                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <p class="text-muted text-dark">حساب کاربری ندارید؟<a href="{{url('user/register')}}"
                                                                                  class="text-primary m-l-5"><b>عضو
                                        شوید</b></a></p>
                        </div>
                    </div>
                </div>

            </div>


        </div>
        <!-- end card-box -->
        <div class="card-box text-center">
            <h3>راههای ارتباطی</h3>
            <ul class="list-inline">
                <li><a href="https://t.me/adclicki"><i class="fa fa-telegram" style="font-size: 30px"></i></a> </li>
                <li><a href="https://instagram.com/adclicki"><i class="fa fa-instagram" style="font-size: 30px"></i></a> </li>
                <li><a href="mailto:adclicki.ir@gmail.com?subject= سایت اد کلیکی  &amp;body="><i class="fa fa-google" style="font-size: 30px"></i></a> </li>
                <li><a href="{{url('')}}"><i class="fa fa-internet-explorer" style="font-size: 30px"></i></a> </li>
                <li>  <a href="tel://09126145705">    <i class="fa fa-mobile" style="font-size: 30px"></i> </a> </li>
                <h3 >{{convert_to_digit('09126145705')}}</h3>

            </ul>
        </div>
    </div>

</div>


</div>


<!-- jQuery  -->

<script>
    $('#login_site').on('click', function () {


        $('#email_error').text('');
        $('#password_error').text('');
        $('#loader3').show();
        $.ajax({
            url: "{{url('site/login')}}",
            type: "POST",
            data: {
                "_token": '<?php echo csrf_token()?>',
                "email": $('#email').val(),
                'password': $('#password').val()


            },
            success: function (data) {


                $('#loader3').hide();
                if (data.authentication) {
                    location.href = data.redirect;
                } else {

                    alert(data.message)
                }


            },
            error: function (error) {
                $('#loader3').hide();
                if (error.status === 422) {
                    var errors = $.parseJSON(error.responseText);
                    $.each(errors.errors, function (key, val) {
                        $("#" + key + "_error").text(val[0]);
                    });
                }
            }
        });

    });
</script>

</body>
</html>


