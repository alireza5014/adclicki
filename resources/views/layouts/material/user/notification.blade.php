@extends('layouts.material.layout')
@section('header')
    <link href="{{asset('template/adminto/assets/plugins/switchery/switchery.min.css')}}" rel="stylesheet"/>

    @parent

    <title> اعلانها </title>

@endsection
@section('content')
    <div class="container">
        @component('help',['content'=>
        '<p>  با عضویت در ربات <code dir="ltr">@adclicki_bot</code> می توانید از فعالیت های خود در حساب کاربری مطلع شوید.<p>'])@endcomponent


        <div class="card">
            <div class="card-header"> فعالسازی اعلان ها</div>

            <div class="card-block">


                <div class="row">
                    <div class="col-md-6">


                        <div class="row">

                            <div class="col-sm-9">
                                <p class="">ورود به حساب کاربری :</p>

                            </div>
                            <div class="col-sm-3">

                                <div class="form-group">
                                    <div class="toggle-switch ">
                                        <input type="checkbox" class="toggle-switch__checkbox"
                                               onchange="setNotification(this.id)" id="login"
                                               @if($notification->login==1) checked
                                                @endif>
                                        <i class="toggle-switch__helper"></i>
                                    </div>
                                </div>

                            </div>


                            <div class="col-sm-9">
                                <p class="">عضویت زیر مجموعه ها : </p>

                            </div>
                            <div class="col-sm-3">

                                <div class="form-group">
                                    <div class="toggle-switch ">
                                        <input type="checkbox" class="toggle-switch__checkbox"
                                               onchange="setNotification(this.id)" id="register_referer"
                                               @if($notification->register_referer==1) checked
                                                @endif>
                                        <i class="toggle-switch__helper"></i>
                                    </div>
                                </div>

                            </div>


                            <div class="col-sm-9">
                                <p class="">تیکت پشتیبانی : </p>

                            </div>
                            <div class="col-sm-3">

                                <div class="form-group">
                                    <div class="toggle-switch ">
                                        <input type="checkbox" class="toggle-switch__checkbox"
                                               onchange="setNotification(this.id)" id="ticket"
                                               @if($notification->ticket==1) checked
                                                @endif>
                                        <i class="toggle-switch__helper"></i>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"> توجه</div>


                            <div class="panel-body">
                                <p>
                                    با عضویت در ربات <code dir="ltr">@adclicki_bot</code> می توانید از فعالیت های خود در
                                    حساب
                                    کاربری مطلع شوید.
                                </p>
                                <p> کد فعالسازی شما : <code dir="ltr">{{base64_encode(getUserId())}}</code></p>
                                <a class="btn btn-sm btn-primary"
                                   href="https://t.me/adclicki_bot?start=code_{{base64_encode(getUserId())}}">برای عضویت
                                    در ربات تلکرام اینجا کلیک کنید </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>

    <script>
        function setNotification(id) {

            $.ajax({
                url: "{{route('user.notification.modify')}}",
                type: "POST",
                data: {
                    "_token": '<?php echo csrf_token()?>',
                    "key": id,
                    "value": $('#' + id).val(),

                },
                success: function (data) {
                    console.log(data.message)
                    if (data.status === 1) {

                        var value = $(this).val();
                        $(this).val(value * -1);
                    }
                    else if (data.status === 0) {


                    }

                },
                error: function (error) {


                }
            });
        }


    </script>



@stop


@section('js')
    <script src="{{asset('template/adminto/assets/plugins/switchery/switchery.min.js')}}"></script>

    @parent


@endsection