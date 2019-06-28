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
                <a href=""> <span class="fa fa-home"></span> </a>
                <i class="fa fa-angle-left"></i>
                <span>داشبورد</span>
            </div>
            <div class= "main-content"  class="span8">
                <div class="row-fluid">				<div class="box span12">
                        <div class="title"><h1>ثبت نام</h1></div>
                        <div class="body">
                            <div class="login-form">
                                <div class="login-form-header">
                                    <h3> ثبت نام </h3>
                                </div>
                                <div class="login-form-content"><form class="form-horizontal login-form-box" action="" method="post">
                                        <!--<div class="row-fluid">-->
                                        <!--<div class="span12">-->
                                        <!--<p class="text-info">-->
                                        <!--</p>-->
                                        <!--</div>-->
                                        <!--</div>-->

                                        <div class="control-group">
                                            <label for="fname" class="control-label"></label>
                                            <div class="controls">
                                                <input placeholder="نام *" type="text" name="fname" id="fname" maxlength="50" value="" class="validate[required,maxSize[50]]" />
                                                <p id="fname_error" class="text-danger"></p>

                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label for="lname" class="control-label"></label>
                                            <div class="controls">
                                                <input placeholder="نام خانوادگی*" type="text" name="lname" id="lname" maxlength="50" value="" class="validate[required,maxSize[50]]" />
                                                <p id="lname_error" class="text-danger"></p>

                                            </div>
                                        </div>


                                        <div class="control-group">
                                            <label for="email" class="control-label"></label>
                                            <div class="controls">
                                                <input placeholder="ایمیل *" type="text" name="email" id="email" dir="ltr" size="50" value="" class="validate[required,custom[email]]" />
                                                <p id="email_error" class="text-danger"></p>

                                            </div>
                                        </div>


                                        <div class="control-group">
                                            <label for="password" class="control-label"></label>
                                            <div class="controls">
                                                <input placeholder="کلمه عبور *" type="password" name="password" id="password" dir="ltr" value="" class="validate[required]" />
                                                <p id="password_error" class="text-danger"></p>

                                            </div>
                                        </div>

 


                                        <div class="control-group">
                                            <label for="mobile" class="control-label"></label>
                                            <div class="controls">
                                                <input placeholder="تلفن همراه *" type="text" name="mobile" id="mobile" dir="ltr" value="" class="validate[required]" />
                                                <span class="help-block">مثال : 09123456789</span>
                                                <p id="mobile_error" class="text-danger"></p>

                                            </div>
                                        </div>





                                        <div class="control-group">
                                            <label for="bank_name" class="control-label"></label>
                                            <div class="controls">
                                                <input placeholder="نام بانک " type="text" name="bank_name" id="bank_name" value="" class="" />

                                            </div>
                                        </div>


                                        <div class="control-group">
                                            <label for="shaba_number" class="control-label"></label>
                                            <div class="controls">
                                                <div class=" input-append">		<input placeholder="شبای حساب بانکی " type="text" name="shaba_number" id="shaba_number" dir="ltr" value="" class="" />
                                                    <span class="add-on">IR</span></div>			<span class="help-block">مثال : <span style="direction:ltr">IR01 1234 5678 0123 4567 8901 23</span><br />حساب بانکی باید به نام خود شما باشد، در غیر اینصورت تسویه حساب انجام نخواهد شد.<br />در صورتی که نمیدانید شبا چیست و یا شبای حساب خود را چگونه میتوانید دریافت کنید، <a href="" target="_blank">اینجا کلیک کنید</a>.<br />در صورت لزوم میتوانید شبای حساب خود را بعدا وارد نمایید.</span>

                                            </div>
                                        </div>


                                        <div class="control-group">
                                            <label for="card_number" class="control-label"></label>
                                            <div class="controls">
                                                <input placeholder="شماره کارت بانکی " type="text" name="card_number" id="card_number" dir="ltr" value="" class="" />
                                                <span class="help-block">شماره کارت عابر بانک خود را که یک کد 16 رقمی میباشد را <b>بدون فاصله </b>وارد نمایید<br />در صورت لزوم میتوانید شماره کارت خود را بعدا وارد نمایید.</span>

                                            </div>
                                        </div>


                                        <div class="control-group">
                                            <label for="tos" class="control-label"></label>
                                            <div class="controls">
                                                <div class="checkbox">

                                                    <input class='testh' type="checkbox" name="tos" id="tos" value="1" class="validate[required]"/>
                                                    <label for="tos"  ></label>
                                                </div>
                                                <span class="help-block">بعد از مطالعه دقیق <a href="{{url('terms')}}" target="_blank">قوانین وبسایت</a>، در صورت تایید، این گزینه را تیک بزنید.</span>

                                            </div>
                                        </div>

                                        <p class="form-submit" align="center">
                                        <p id="ip_error" class="text-danger"></p>

                                        <a  id="register_site"  class="button ">

                                                ثبت نام
                                                <i style="display: none;color: #c10000 !important;" id="loader2" class="fa fa-spinner fa-spin "></i>

                                            </a> &nbsp;&nbsp;
                                        </p>

                                    </form></div></div>					</div>
                    </div>							</div>
                <div class="row-fluid" id="inline_load" style="display: none;"></div>
            </div>
        </section>	   	</main>
    <script>

        $('#register_site').on('click', function () {


            $('#loader2').show();


            $('#email_error').text('');
            $('#password_error').text('');
            $('#fname_error').text('');
            $('#lname_error').text('');
            $('#ip_error').text('');
            $('#mobile_error').text('');
            $('#activity_type_error').text('');

            $.ajax({
                url: "{{url('site/register')}}",
                type: "POST",
                data: {
                    "_token": '<?php echo csrf_token()?>',
                    "ip": '<?php echo getIP()?>',
                    "fname": $('#fname').val(),
                    "lname": $('#lname').val(),

                    "email": $('#email').val(),
                    "referer_id": '{{Illuminate\Support\Facades\Input::get('referer_id', 0)}}',
                    "is_free_job": 0,
                    "password": $('#password').val(),
                    "mobile": $('#mobile').val(),
                    "card_number": $('#card_number').val(),
                    "shaba_number": $('#shaba_number').val(),
                    "bank_name": $('#bank_name').val(),
                    "activity_type": 2


                },
                success: function (data) {


                    $('#loader2').hide();
                    if (data.authentication) {
                        location.href = data.redirect;
                    } else {

                        alert('sms cod is invalid')
                    }


                },
                error: function (erorr) {
                    $('#loader2').hide();

                    if (erorr.status === 422) {
                        var errors = $.parseJSON(erorr.responseText);
                        console.log(errors);
                        $.each(errors.errors, function (key, val) {
                            $("#" + key + "_error").text(val[0]);
                        });
                    }
                }
            });

        });

    </script>
@endsection