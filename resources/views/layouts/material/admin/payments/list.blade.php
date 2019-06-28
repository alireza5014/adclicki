@extends('layouts.material.layout')
@section('header')
    @parent

    <title> لیست کاربران </title>

@endsection
@section('content')

    <div class="col-md-12 ">

        <div  class="row quick-stats">
            <a href="{{url('admin/ads/payments')}}/all" class="col-sm-6 col-md-3">
                <div class="quick-stats__item bg-light-green">
                    <div class="quick-stats__info">
                        <h2> </h2>
                        <small> همه  پرداخت ها</small>
                    </div>

                    <div class="quick-stats__chart sparkline-bar-stats"><canvas width="58" height="36" style="display: inline-block; width: 58px; height: 36px; vertical-align: top;"></canvas></div>
                </div>
            </a>

            <a href="{{url('admin/ads/payments')}}/3" class="col-sm-6 col-md-3">
                <div class="quick-stats__item bg-red">
                    <div class="quick-stats__info">
                        <h2> </h2>
                        <small>  پرداخت شده به کاربر</small>
                    </div>

                    <div class="quick-stats__chart sparkline-bar-stats"><canvas width="58" height="36" style="display: inline-block; width: 58px; height: 36px; vertical-align: top;"></canvas></div>
                </div>
            </a>

            <a href="{{url('admin/ads/payments')}}/2" class="col-sm-6 col-md-3">
                <div class="quick-stats__item bg-purple">
                    <div class="quick-stats__info">
                        <h2> </h2>
                        <small> واریز شده از سوی کاربر</small>
                    </div>

                    <div class="quick-stats__chart sparkline-bar-stats"><canvas width="58" height="36" style="display: inline-block; width: 58px; height: 36px; vertical-align: top;"></canvas></div>
                </div>
            </a>

            <a href="{{url('admin/ads/payments')}}/1" class="col-sm-6 col-md-3">
                <div class="quick-stats__item bg-amber">
                    <div class="quick-stats__info">
                        <h2> </h2>
                        <small>      خرید کلیک</small>
                    </div>

                    <div class="quick-stats__chart sparkline-bar-stats"><canvas width="58" height="36" style="display: inline-block; width: 58px; height: 36px; vertical-align: top;"></canvas></div>
                </div>
            </a>


        </div>

    <div class="card">


            <div class="card-block">


                @include('layouts.material.admin.payments.table')

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

                function confirm(id) {

                    event.preventDefault();
                    $('#loader' + id).show();

                    $.ajax({
                        url: 'confirm/' + id,
                        success: function (data) {
                            if (data.status) {
                                $('#loader' + id).hide();

                                var status;
                                (data.publish === 1) ? status = [['text-success', 'تایید شده'], ['text-danger', ' منتظر تایید کارشناس']] : status = [['text-danger', ' منتظر تایید کارشناس'], ['text-success', 'تایید شده']];
                                $('#confirm_' + id).children("i").addClass(status[0][0]).removeClass(status[1][0]);
                                $('#confirm_' + id).children("p").text(status[0][1])

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

                            }
                            $('#view_request_alert').show();

                            $('#view_request_message').text(data.message)
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

                    $('#ads_title').text(title);
                    $('#ads_id').val(id);
                }


            </script>

@stop