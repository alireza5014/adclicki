@extends('layouts.material.layout')
@section('header')
    @parent

    <title> لیست تبلیغات جستجو گوگل </title>
    <style>
        .p_wink {
            color: #ff0e13;
            animation: notification-container 1s linear infinite;
        }

        @keyframes notification-container {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }
    </style>
@endsection
@section('content')
    <div id="view_request_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-no-padding">


                <div class="modal-body">

                    <div class="container">
                        <p class="text-danger" id="view_request_message"></p>


                        <form id="view_request_form" class="form-horizontal" action="action_page.php">

                            <div class="form-group">
                                <p class="  col-sm-12  text-center ">
                                    تعداد جستجو های خود را جهت
                                    اختصاص به تبلیغ <br/><b class="text-danger" id="ads_title"></b><br/> وارد کنید</p>

                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="c_mobile">تعداد:</label>
                                <div class="col-sm-9">
                                    <input type="hidden" class="form-control input-sm" id="ads_id" name="ads_id">
                                    <input type="text" class="form-control input-sm" id="count" name="count"
                                           placeholder="">
                                    <p id="count_errors" class="text-danger"></p>

                                </div>

                            </div>


                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <a id="view_request_btn" class="btn   btn-block btn-primary  ">
                                        تخصیص جستجو
                                        <i style="display: none" id="loader40" class="fa fa-spinner fa-spin "></i>

                                    </a>
                                </div>
                            </div>
                        </form>

                    </div>


                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


    </div>


    @component('help',['content'=>
    "      <b> توجه داشته باشید هرکلیک سرچ گوگل معادل 5 کلیک میباشد  موجودی کلیک شما <code>".getTotalClick()."</code> کلیک میباشد که میتوانید تعداد    <code>".getTotalSearch()."</code> کلیک سرچ گوگل ثبت نمایید
        </b>
  <p>
        توجه : برای فعال شدن تبلیغ سرچ گوگل باید کد زیر را کپی کرده و در فوتر سایت خود قرار دهید   بطوری که در تمام صفحات قابل مشاهده باشد
    </p>

        <textarea  rows='2' class='form-control ' dir='ltr'><script type='text/javascript' src='https://www.adclicki.ir/js/pgk.js'></script> <a id='demo' href='https://www.adclicki.ir/user/pgk/".auth('user')->user()->id."'>-</a> </textarea>

    <p class=''>ویا اگر سایت شما از فعال بودن اسکریپت جلوگیری میکند لینک زیر را در فوتر سایت خود قرار  دهید</p>

        <textarea rows='2' class='form-control ' dir='ltr'> <a   href='https://www.adclicki.ir/user/pgk/".auth('user')->user()->id."/google' rel='nofollow'  target='_blank'> ( کسب امتیاز ) </a> </textarea>

    "

 ])@endcomponent





    <div class="card">


        <a href="{{route('user.ads.google_search.new')}}" class="btn btn-success btn-xs">ثبت تبلیغ جستجو
            گوگل جدبد</a>
    </div>
    <div class="col-md-12 ">


        <div class="card">
            <div class="card-block">


                @include('layouts.material.user.ads.google_search.table')

            </div>
        </div>

        <script>
            $(document).ready(function () {

                $(document).on('click', '.pagination a', function (event) {
                    event.preventDefault();
                    $('#loader').show();
                    var page = $(this).attr('href');
                    fetch_data(page);
                });


            });

            function fetch_data(page) {
                $.ajax({
                    url: page,
                    success: function (data) {
                        $('.card-block').html(data);
                        $('#loader').hide();

                    }
                });
            }

        </script>

        <script>

            function active(id) {

                event.preventDefault();
                $('#loader' + id).show();

                $.ajax({
                    url: 'active/' + id,
                    success: function (data) {
                        if (data.status) {
                            $('#loader' + id).hide();

                            var status;
                            (data.publish === 1) ? status = [['text-success', 'منتشر شده'], ['text-danger', 'منتشر نشده']] : status = [['text-danger', 'منتشر نشده'], ['text-success', 'منتشر شده']];
                            $('#active_' + id).children("i").addClass(status[0][0]).removeClass(status[1][0]);
                            $('#active_' + id).children("p").text(status[0][1])

                        }


                    }
                });

            }


        </script>


        <script>
            $('#view_request_btn').on('click', function () {


                $('#loader40').show();
                $('#count_errors').text('');


                $.ajax({
                    url: "{{route('user.view_request.save')}}",
                    type: "POST",
                    data: {
                        "_token": '<?php echo csrf_token()?>',

                        "count": $('#count').val(),
                        "ads_id": $('#ads_id').val(),


                    },
                    success: function (data) {
                        $('#loader40').hide();
                        if (data.status === 1) {
                            $('#view_request_form').slideUp();
                            setInterval(function () {
                                location.href = 'list';
                            }, 2000)

                        }
                        $('#view_request_alert').show();

                        $('#view_request_message').append(data.message);
                    },
                    error: function (error) {
                        console.log(error);

                        if (error.status === 422) {
                            var errors = $.parseJSON(error.responseText);


                            $.each(errors.errors, function (key, val) {
                                $("#" + key + "_errors").text(val[0]);
                            });
                        }
                        $('#loader40').hide();

                    }
                });

            });


            function setModal(id, title) {

                $('#view_request_message').text('');


                $('#view_request_form').slideDown();


                $('#view_request_alert').hide();


                $('#count').val(0);

                $('#ads_title').text(title);
                $('#ads_id').val(id);
            }


        </script>

    </div>
@stop