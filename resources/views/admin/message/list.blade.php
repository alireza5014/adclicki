@extends('layouts.adminto.layout')
@section('header')
    @parent

    <title> لیست تبلیغات کلیکی </title>
    <link href="{{asset('template/adminto/assets/plugins/switchery/switchery.min.css')}}" rel="stylesheet"/>

@endsection
@section('content')
    <div id="show_message" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-no-padding">

                <h3 id="title"></h3>
                <p id="description"></p>
                <p id="users"> </p>
            </div><!-- /.modal-content -->

        </div>

    </div><!-- /.modal-dialog -->
    <div id="send_message" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-no-padding">
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data"
                          action="{{ route('admin.send_message_to_all_user') }}">
                        {{ csrf_field() }}

                        <div class="form-group">

                            <div class="col-md-12">
                                <input class="form-control" placeholder="title" name="title" id="title" required>
                            </div>
                        </div>

                        <div class="form-group">


                            <div class="col-md-12">
                                <textarea class="form-control" placeholder="description" name="description"
                                          id="description" required></textarea>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-md-12">
                                <input type="file" class="form-control" name="main_image" id="main_image" >
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="name" class="col-md-6 control-label"> ارسال به تلگرام : </label>

                            <div class="col-md-6">
                                <input
                                        name="telegram"
                                        id="telegram"
                                        data-size="small"
                                        type="checkbox"
                                        data-plugin="switchery"
                                        data-color="#00b19d"/>
                            </div>
                        </div>


                        <div class="form-group">

                            <div class="col-md-12">
                                <input type="submit" class="btn btn-md btn-primary btn-block" value="SEND">
                            </div>
                        </div>
                    </form>
                </div><!-- /.modal-content -->

            </div>
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

                    <a
                            data-toggle="modal" data-target="#send_message"
                            type="submit" class="btn btn-xs btn-success pull-left"> ارسال پیام عمومی </a>

                    {{--                    <a href="{{route('user.ads.message.new')}}" class="btn btn-success btn-xs">ثبت تبلیغ کلیکی جدبد</a>--}}
                </div>
                <hr/>

                @include('admin.message.table')

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

        @section('js')
            <script src="{{asset('template/adminto/assets/plugins/switchery/switchery.min.js')}}"></script>

    @parent


@endsection