@extends('layouts.adminto.layout')
@section('header')
    @parent

    <title> لیست تبلیغات کلیکی </title>
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
    <div id="show_message" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-no-padding">

                <h3 id="title"></h3>
                <p id="description"></p>
            </div><!-- /.modal-content -->

        </div>

    </div><!-- /.modal-dialog -->

    <div class="row">



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

                    {{--                    <a href="{{route('user.ads.message.new')}}" class="btn btn-success btn-xs">ثبت تبلیغ کلیکی جدبد</a>--}}
                </div>
                <hr/>

                @include('user.message.table')

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


        </div>
@stop