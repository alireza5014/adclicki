@extends('layouts.material.layout')
@section('header')
    @parent

    <title>     خرید کلیکی </title>

@endsection
@section('content')
    @component('help',['content'=>
'<p>  بعد از خرید به منوی <code>مدیریت تبلیغات من -> لیست تبلیغات کلیکی من</code>  رفته و به آگهی مورد نظر تخصیص دهید <p>'])@endcomponent

    <div class="container">


        <div class="card">



            <div class="card-block">

                <div class="row">
               <div class="col-sm-6">
                    <div class="card-header">خرید کیلیک  </div>



                        <form class="form-horizontal" role="form" method="POST" action="{{ route('user.payment.pay') }}">
                            {{ csrf_field() }}


                            <div class="col-sm-12">
                                <div class="form-group form-group--float">
                                    <input  dir="ltr" id="click_count" type="number" class="form-control" name="click_count"
                                      >
                                    <label> تعداد کلیک های درخواستی خود را وارد </label>
                                    <i class="form-group__bar"></i>

                                </div>
                                <p class="text-danger" id="click_count_errors"></p>

                            </div>





                            <div class="form-group">
                                <div class="col-md-12">
                                    <a id="buy_click_btn" class="btn btn-success btn-block">
                                        <i style="display: none" id="loader40" class="fa fa-spinner fa-spin "></i>

                                        محاسبه کلیک های درخواستی
                                    </a>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12  ">
                                    <p class="text-danger"> تعداد <code id="count">0</code> کلیک | مبلغ <code
                                                id="price">0</code> تومان</p>
                                </div>
                            </div>



                            <div class="form-group" id="pay" style="display: none;">
                                <div class="col-md-12  ">
                                 <button type="submit" class="btn btn-block btn-info" >جهت خرید و پرداخت کلیک های درخواستی کلیک کنید</button>
                                </div>
                            </div>
                        </form>
                    </div>



            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">  تعرفه خرید کلیک  </div>


                    <div class="panel-body">
                <ul class="list-group">
                    <li class="list-group-item">از 200 کلیک تا 10,000 کلیک , هرکلیک 10 تومان (100 ریال)</li>
                </ul>
                    </div>
                </div>
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