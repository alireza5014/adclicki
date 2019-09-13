@extends('layouts.site1.layout')
@section('head')
    @parent

    <title>بازیابی رمز عبور اد کلیکی</title>


    <meta name="keywords" content="بازیابی رمز عبور اد کلیکی  تبلیغات کلیکی  ">
    <meta name="description" content="  بازیابی رمز عبور اد کلیکی">
    <meta name="author" content="  علیرضا حیدری">


    <meta property="og:image" content="https://adclicki.ir/adclicki.jpg"
          data-react-helmet="true">
    <meta property="og:image:width" content="1161" data-react-helmet="true">
    <meta property="og:image:height" content="1022" data-react-helmet="true">
    <meta property="twitter:card" content="summary_large_image" data-react-helmet="true">
    <meta property="twitter:site" content="@adclicki_ir" data-react-helmet="true">

    <meta property="twitter:creator" content="@adclicki_ir" data-react-helmet="true">
    <meta property="twitter:description"
          content="بازیابی رمز عبور اد کلیکی"
          data-react-helmet="true">
    <meta property="twitter:title"
          content=" بازدید سایت رو خیلی راحت بالا ببر و بیا صفحه اول گوگل. افزایش رتبه گوگل و کاهش رتبه الکسا صد در صد تضمینی   "
          data-react-helmet="true">
    <meta property="og:description"
          content="بازیابی رمز عبور اد کلیکی"
          data-react-helmet="true">
    <meta property="og:title"
          content=" بازدید سایت رو خیلی راحت بالا ببر و بیا صفحه اول گوگل. افزایش رتبه گوگل و کاهش رتبه الکسا صد در صد تضمینی   "
          data-react-helmet="true">
    <meta name="description"
          content="بازیابی رمز عبور اد کلیکی"
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
                        <div class="title"><h1> بازیابی رمز عبور</h1></div>
                        <div class="body">


                            <div class="login-form test">
                                <div class="login-form-header">
                                    <h3> بازیابی رمز عبور </h3>
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


                                        <p class="form-submit" align="center">

                                            <button type="button" id="recover_password"
                                                    class="button a_width">
                                                بازیابی
                                                <i style="display: none" id="loader3"
                                                   class="fa fa-spinner fa-spin text-danger "></i>

                                            </button>


                                        </p>

                                    </form>
                                    <div class="forget-pass">
                                        <a href="{{url('login')}}">حساب کاربری دارید ؟ ورود به حساب کاربری.</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-fluid" id="inline_load" style="display: none;"></div>
            </div>
        </section>
    </main>
    <script>
        $('#recover_password').on('click', function () {


            $('#email_error').text('');

            $('#loader3').show();
            $("#recover_password").attr("disabled", true);

            $.ajax({
                url: "{{url('get_recovery_code')}}",
                type: "POST",
                data: {
                    "_token": '<?php echo csrf_token()?>',
                    "email": $('#email').val(),


                },
                success: function (data) {

                    $("#recover_password").removeAttr("disabled");

                    $('#loader3').hide();
                    if (data.status) {

                        alert(data.message)
                        location.href =data.redirect;
                    } else {

                        alert(data.message)
                    }


                },
                error: function (error) {
                    $('#loader3').hide();
                    $("#recover_password").removeAttr("disabled");

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