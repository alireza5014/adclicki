@extends('layouts.site1.layout')
@section('head')
    @parent

    <title>تعیین رمز جدید اد کلیکی </title>


    <meta name="keywords" content="تعیین رمز جدید اد کلیکی  تبلیغات کلیکی  ">
    <meta name="description" content="تعیین رمز جدید اد کلیکی">
    <meta name="author" content="  علیرضا حیدری">


    <meta property="og:image" content="https://adclicki.ir/adclicki.jpg"
          data-react-helmet="true">
    <meta property="og:image:width" content="1161" data-react-helmet="true">
    <meta property="og:image:height" content="1022" data-react-helmet="true">
    <meta property="twitter:card" content="summary_large_image" data-react-helmet="true">
    <meta property="twitter:site" content="@adclicki_ir" data-react-helmet="true">

    <meta property="twitter:creator" content="@adclicki_ir" data-react-helmet="true">
    <meta property="twitter:description"
          content="تعیین رمز جدید اد کلیکی"
          data-react-helmet="true">
    <meta property="twitter:title"
          content=" بازدید سایت رو خیلی راحت بالا ببر و بیا صفحه اول گوگل. افزایش رتبه گوگل و کاهش رتبه الکسا صد در صد تضمینی   "
          data-react-helmet="true">
    <meta property="og:description"
          content="تعیین رمز جدید اد کلیکی"
          data-react-helmet="true">
    <meta property="og:title"
          content=" بازدید سایت رو خیلی راحت بالا ببر و بیا صفحه اول گوگل. افزایش رتبه گوگل و کاهش رتبه الکسا صد در صد تضمینی   "
          data-react-helmet="true">
    <meta name="description"
          content="تعیین رمز جدید اد کلیکی"
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

                        <div class="login-form test">
                            <p> سلام ! {{$user->fname." ".$user->lname}}</p>
                            <p class=""> لطفاْ یک رمز عبور جدید برای خود انتخاب کنید </p>

                            <div class="login-form-header">
                                <h3> تعیین رمز جدید </h3>
                            </div>

                            <div class="login-form-content">
                                <form class="form-horizontal login-form-box" action="{{url('do_reset_password')}}"
                                      method="post">
                                    <input id="recovery_link" value="{{$user->recovery_link}}" type="hidden">
                                    <div class="control-group">
                                        <label for="password" class="control-label"></label>
                                        <div class="controls">
                                            <input placeholder="کلمه عبور جدید" type="password" autocomplete="password"
                                                   name="password"
                                                   id="password" dir="ltr" value=""
                                            />
                                            <p id="password_error" class="text-danger"></p>

                                        </div>
                                    </div>


                                    <div class="control-group">
                                        <label for="re_password_error" class="control-label"></label>
                                        <div class="controls">
                                            <input placeholder="تکرار کلمه عبور جدید" autocomplete="password"
                                                   type="password" name="re_password"
                                                   id="re_password" dir="ltr" value=""
                                            />
                                            <p id="re_password_error" class="text-danger"></p>

                                        </div>
                                    </div>


                                    <p class="form-submit" align="center">

                                        <button type="button" id="reset_password_site"
                                                class="button a_width">
                                            تعیین رمز جدید
                                            <i style="display: none;background: #c10000" id="loader3"
                                               class="fa fa-spinner fa-spin "></i>

                                        </button>


                                    </p>

                                </form>

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
        $('#reset_password_site').on('click', function () {

            if ($('#password').val() == $('#re_password').val()) {


                $('#password_error').text('');
                $('#loader3').show();
                $("#reset_password_site").attr("disabled", true);

                $.ajax({
                    url: "{{url('do_reset_password')}}",
                    type: "POST",
                    data: {
                        "_token": '<?php echo csrf_token()?>',

                        'password': $('#password').val(),
                        're_password': $('#re_password').val(),
                        'recovery_link': $('#recovery_link').val()


                    },
                    success: function (data) {
                        console.log(data);

                        $('#loader3').hide();
                        if (data.status === 1) {
                            alert(data.message)

                            location.href = data.redirect;
                        } else {

                            alert(data.message)
                        }
                        $("#reset_password_site").removeAttr("disabled");


                    },
                    error: function (error) {
                        $('#loader3').hide();
                        $("#reset_password_site").removeAttr("disabled");

                        if (error.status === 422) {
                            var errors = $.parseJSON(error.responseText);
                            $.each(errors.errors, function (key, val) {
                                $("#" + key + "_error").text(val[0]);
                            });
                        }
                    }
                });
            }
            else {
                alert("رمز جدید با تکرار رمز جدید یکسان نیست")
            }
        });
    </script>
@endsection