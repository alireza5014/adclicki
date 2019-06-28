@extends('layouts.adminto.layout')
@section('header')
    @parent

    <title>     خرید کلیکی </title>
    <!-- Css files-->
    <link rel="stylesheet" type="text/css" href="{{url('crop/css/style.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('crop/css/style-example.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('crop/css/jquery.Jcrop.css')}}"/>

    <script type="text/javascript" src="{{url('crop/scripts/jquery.Jcrop.js')}}"></script>
    <script type="text/javascript" src="{{url('crop/scripts/jquery.SimpleCropper.js')}}"></script>

@endsection
@section('content')
    <div class="container">


        <div class="row">


            @component('help',['content'=>
'<p>  بعد از خرید به منوی <code>مدیریت تبلیغات من -> لیست تبلیغات کلیکی من</code>  رفته و به آگهی مورد نظر تخصیص دهید <p>'])@endcomponent

            <div class="col-md-6 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">خرید کیلیک  </div>


                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('user.payment.pay') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('click_count') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-6 control-label">تعداد کلیک های درخواستی خود را وارد
                                    کنید: </label>

                                <div class="col-md-6">
                                    <input dir="ltr" id="click_count" type="number" class="form-control"
                                           name="click_count"
                                           value="{{old('click_count')}}">
                                    <p class="text-danger" id="click_count_errors"></p>
                                    {{--@component('input_error',['name' => 'title'])@endcomponent--}}

                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-6">
                                    <a id="buy_click_btn" class="btn btn-danger btn-block">
                                        <i style="display: none" id="loader40" class="fa fa-spinner fa-spin "></i>

                                        محاسبه کلیک های درخواستی
                                    </a>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <p class="text-danger"> تعداد <code id="count">0</code> کلیک | مبلغ <code
                                                id="price">0</code> تومان</p>
                                </div>
                            </div>



                            <div class="form-group" id="pay" style="display: none;">
                                <div class="col-md-6 col-md-offset-3">
                                 <button type="submit" class="btn btn-md btn-info" >جهت خرید و پرداخت کلیک های درخواستی کلیک کنید</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">  تعرفه خرید کلیک  </div>


                    <div class="panel-body">
                <ul class="list-group">
                    <li class="list-group-item">از 1,000 کلیک تا 10,000 کلیک , هرکلیک 15 تومان (150 ریال)</li>
                </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#buy_click_btn').on('click', function () {


            $('#loader40').show();
            $('#click_count_errors').text('');


            $.ajax({
                url: "{{route('user.payments.click_calculate')}}",
                type: "POST",
                data: {
                    "_token": '<?php echo csrf_token()?>',

                    "click_count": $('#click_count').val(),


                },
                success: function (data) {
                    $('#loader40').hide();
                    if (data.status === 1) {
                        // $('#view_request_form').slideUp();
                        $('#count').text(data.count);
                        $('#price').text(data.price);
                        $('#pay').show();
                    }
                    else if (data.status === 0) {
                        $('#count').text(0);
                        $('#price').text(0);
                        $('#pay').hide();
                        alert(data.message);
                    }

                },
                error: function (error) {
                    $('#count').text(0);
                    $('#price').text(0);
                    $('#pay').hide();

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


    </script>
@stop