@extends('layouts.site1.layout')
@section('head')
    @parent

    <title>کاهش رتبه الکسا | افزایش رتبه گوگل |افزایش بازدید سایت</title>


    <meta name="keywords" content="ورود به حساب کاربری اد کلیکی  تبلیغات کلیکی  ">
    <meta name="description" content="رورود به حساب کاربری اد کلیکی">
    <meta name="author" content="  علیرضا حیدری">


    <meta property="og:image" content="https://adclicki.ir/adclicki.jpg"
          data-react-helmet="true">
    <meta property="og:image:width" content="1161" data-react-helmet="true">
    <meta property="og:image:height" content="1022" data-react-helmet="true">
    <meta property="twitter:card" content="summary_large_image" data-react-helmet="true">
    <meta property="twitter:site" content="@adclicki_ir" data-react-helmet="true">

    <meta property="twitter:creator" content="@adclicki_ir" data-react-helmet="true">
    <meta property="twitter:description"
          content="رورود به حساب کاربری اد کلیکی"
          data-react-helmet="true">
    <meta property="twitter:title"
          content=" بازدید سایت رو خیلی راحت بالا ببر و بیا صفحه اول گوگل. افزایش رتبه گوگل و کاهش رتبه الکسا صد در صد تضمینی   "
          data-react-helmet="true">
    <meta property="og:description"
          content="رورود به حساب کاربری اد کلیکی"
          data-react-helmet="true">
    <meta property="og:title"
          content=" بازدید سایت رو خیلی راحت بالا ببر و بیا صفحه اول گوگل. افزایش رتبه گوگل و کاهش رتبه الکسا صد در صد تضمینی   "
          data-react-helmet="true">
    <meta name="description"
          content="رورود به حساب کاربری اد کلیکی"
          data-react-helmet="true">



@stop

@section('content')

    <main>
        <section class="main " role="main">
            <div class="breadcrumb">
                <a href="../index.html"> <span class="fa fa-home"></span> </a>
                <i class="fa fa-angle-left"></i>
                <span>داشبورد</span>
            </div>
            <div class="main-content" class="span8">
                <div class="row-fluid">
                    <div class="box span12">
                        <div class="title"><h1>ورود کاربر</h1></div>
                        <div class="body">


                            <div class="login-form test">
                                <div class="login-form-header">
                                    <h3> ورود به پنل کاربری </h3>
                                </div>
                                <div class="login-form-content">
                                    <form class="form-horizontal login-form-box" action="signin.html" method="post">

                                        <div class="control-group">
                                            <label for="field_email" class="control-label"></label>
                                            <div class="controls">
                                                <input placeholder="ایمیل *" type="text" name="email" id="email"
                                                       dir="ltr" size="50" value=""
                                                       class="validate[required,custom[email]]"/>
                                                <p id="email_error" class="text-danger"></p>

                                            </div>
                                        </div>


                                        <div class="control-group">
                                            <label for="field_password" class="control-label"></label>
                                            <div class="controls">
                                                <input placeholder="کلمه عبور *" type="password" name="password"
                                                       id="password" dir="ltr" value=""
                                                       class="validate[required]"/>
                                                <p id="password_error"  class="text-danger"></p>

                                            </div>
                                        </div>


                                        <div class="control-group">
                                            <label for="field_remember" class="control-label"></label>
                                            <div class="controls">
                                                <div class="checkbox">

                                                    <input class='testh' type="checkbox" name="remember"
                                                           id="remember" value="1" class=""/>
                                                    <label for="field_tos"></label>
                                                </div>

                                            </div>
                                        </div>

                                        <p class="form-submit" align="center">

                                            <a id="login_site"
                                               class="button a_width">
                                                ورود
                                                <i style="display: none;color: #c10000 !important;" id="loader3" class="fa fa-spinner fa-spin "></i>

                                            </a>


                                        </p>

                                    </form>
                                    <div class="forget-pass">
                                        <a href="forgotpass.html">رمز عبور خود را فراموش کرده اید ؟</a>
                                    </div>
                                </div>
                                <span class="rules">مرا به خاطر بسپار</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-fluid" id="inline_load" style="display: none;"></div>
            </div>
        </section>
    </main>
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
@endsection