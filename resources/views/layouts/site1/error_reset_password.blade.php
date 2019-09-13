@extends('layouts.site1.layout')
@section('head')
    @parent

    <title>تعیین رمز جدید اد کلیکی </title>


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
                        <h3>خطا</h3>
                        <p>لطفا مجددا اقدام نمایید</p>
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