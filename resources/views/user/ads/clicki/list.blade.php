@extends('layouts.adminto.layout')
@section('header')
    @parent

    <title>  لیست تبلیغات کلیکی </title>
   <style>
       .p_wink{
           color: #ff0e13;
           animation: notification-container 1s linear infinite;
       }

       @keyframes notification-container {
           0%{opacity: 0;}

           100%{opacity: 1;}
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
                                    تعداد کلیک های خود را جهت
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
                                        تخصیص کلیک
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

    <div class="row">

        @component('help',['content'=>
 " <p>  برای نمایش و بازدید آگهی شما در سایت می بایست از قسمت <code>[ تخصیص کلیک ]</code> کلیک های مورد نظر خود را به آگهی خود اختصاص دهید <p>


       "])@endcomponent


        <div class="col-sm-12">


            <div class="card-box">

                <div class="btn-toolbar">

                    <div class="btn-group dropdown-btn-group pull-right">
                        <form method="get" action="" class="input-group" style="width: 250px;">

                            <input type="text" name="keyword" class="form-control input-sm pull-right"
                                   placeholder="Search">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-sm btn-default"><i
                                            class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>

                    <a href="{{route('user.ads.clicki.new')}}" class="btn btn-success btn-xs">ثبت تبلیغ کلیکی جدبد</a>
                </div>
                <hr/>

                @include('user.ads.clicki.table')

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
                            $('.card-box').html(data);
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
                                    location.href='list';
                                },2000)

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