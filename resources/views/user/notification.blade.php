@extends('layouts.adminto.layout')
@section('header')
    <link href="{{asset('template/adminto/assets/plugins/switchery/switchery.min.css')}}" rel="stylesheet"/>

    @parent

    <title>    اعلانها </title>

@endsection
@section('content')
    <div class="container">


        <div class="row">


            @component('help',['content'=>
'<p>  با عضویت در ربات <code dir="ltr">@adclicki_bot</code> می توانید از فعالیت های خود در حساب کاربری مطلع شوید.<p>'])@endcomponent

            <div class="col-md-6 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading"> فعالسازی اعلان ها</div>


                    <div class="panel-body">
                        <div class="form-group">
                            <label for="name" class="col-md-10 control-label"> ورود به حساب کاربری : </label>

                            <div class="col-md-2">
                                <input onchange="setNotification(this.id)" id="login" data-size="small" type="checkbox"

                                       @if($notification->login==1) checked
                                       @endif
                                       data-plugin="switchery" data-color="#00b19d"/>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-md-10 control-label"> عضویت زیر مجموعه ها : </label>

                            <div class="col-md-2">
                                <input onchange="setNotification(this.id)"
                                       id="register_referer"
                                       data-size="small" type="checkbox"
                                       @if($notification->register_referer==1) checked
                                       @endif
                                       data-plugin="switchery"
                                       data-color="#00b19d"/>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-md-10 control-label">   تیکت پشتیبانی : </label>

                            <div class="col-md-2">
                                <input onchange="setNotification(this.id)"
                                       id="ticket"
                                       data-size="small" type="checkbox"
                                       @if($notification->ticket==1) checked
                                       @endif
                                       data-plugin="switchery"
                                       data-color="#00b19d"/>

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
                            با عضویت در ربات <code dir="ltr">@adclicki_bot</code> می توانید از فعالیت های خود در حساب
                            کاربری مطلع شوید.
                        </p>
                        <p> کد فعالسازی شما : <code dir="ltr">{{base64_encode(getUserId())}}</code></p>
                        <a class="btn btn-sm btn-primary" href="https://t.me/adclicki_bot?start=code_{{base64_encode(getUserId())}}">برای عضویت در ربات اینجا کلیک کنید </a>
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
                    "key":id,
                    "value": $('#'+id).val(),

                },
                success: function (data) {
                  console.log(data.message)
                    if (data.status === 1) {

                        var value = $( this ).val();
                       $(this).val(value*-1);
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