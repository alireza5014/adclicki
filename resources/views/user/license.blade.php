@extends('layouts.adminto.layout')

@section('header')
    <link rel="stylesheet" href="{{asset('template/adminto/assets/plugins/morris/morris.css')}}">
    <title>داشبورد</title>
    @parent
@endsection
@section('content')


    <div class="container">

        <div class="row">

            <div class="col-md-8 col-md-offset-1">
                <div class="alert alert-info">
                    <p>برای دریافت کد فعال سازی مبلغ {{number_format($amount)}} تومان  را به شماره کارت ۵۸۵۹۸۳۱۱۰۲۹۴۹۷۲۳ به نام علیرضا حیدری واریز
                        نمایید</p>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Activation</div>


                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('user.getLicense') }}">
                            {{ csrf_field() }}


                            <div class="form-group{{ $errors->has('fname') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">نام :</label>

                                <div class="col-md-6">
                                    <input id="fname" type="text" class="form-control" name="fname"
                                           value="{{ $users->fname}}">

                                    @component('input_error',['name' => 'fname'])@endcomponent

                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('lname') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">نام خانوادگی :</label>

                                <div class="col-md-6">
                                    <input id="lname" type="text" class="form-control" name="lname"
                                           value="{{ $users->lname}}">

                                    @component('input_error',['name' => 'lname'])@endcomponent

                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">ایمیل : </label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ $users->email}}">

                                    @component('input_error',['name' => 'email'])@endcomponent

                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                <label for="mobile" class="col-md-4 control-label">موبایل :</label>

                                <div class="col-md-6">
                                    <input id="mobile" type="text" class="form-control" name="mobile"
                                           value="{{ $users->mobile}}">

                                    @component('input_error',['name' => 'mobile'])@endcomponent

                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('gamenet') ? ' has-error' : '' }}">
                                <label for="gamenet" class="col-md-4 control-label">نام گیم نت :</label>

                                <div class="col-md-6">
                                    <input id="gamenet" type="text" class="form-control" name="gamenet"
                                           value="{{ $users->gamenet}}">

                                    @component('input_error',['name' => 'gamenet'])@endcomponent

                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('client_count') ? ' has-error' : '' }}">
                                <label for="client_count" class="col-md-4 control-label"> تعداد کلاینت ها :</label>

                                <div class="col-md-6">
                                    <input id="client_count" type="number" class="form-control" name="client_count"
                                           value="{{ $users->client_count}}">

                                    @component('input_error',['name' => 'client_count'])@endcomponent

                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('system_code') ? ' has-error' : '' }}">
                                <label for="system_code" class="col-md-4 control-label"> کد سیستم :</label>

                                <div class="col-md-6">
                                    <textarea id="system_code" class="form-control" name="system_code"
                                    >{{$users->system_code}}</textarea>

                                    @component('input_error',['name' => 'system_code'])@endcomponent

                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('software_code') ? ' has-error' : '' }}">
                                <label for="software_code" class="col-md-4 control-label"> کد نرم افزار :</label>

                                <div class="col-md-6">
                                    <textarea id="software_code" class="form-control" name="software_code"
                                    >{{$users->software_code}}</textarea>

                                    @component('input_error',['name' => 'software_code'])@endcomponent

                                </div>
                            </div>


                            @if($users->is_payed)
                                <div class="alert alert-success">
                                    <p>کد فعال سازی شما</p>
                                    <textarea class="form-control" cols="20">{{$users->activation_code}}</textarea>
                                </div>
                            @else
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-btn"></i> دریافت کد فعالسازی
                                        </button>
                                    </div>
                                </div>
                            @endif

                            @if($users->is_payed==0 and strlen($users->activation_code)>0)
                                <div class="alert alert-success">
                                    <h3>کد فعالسازی شما با موفقیت ایجاد شد .</h3>
                                    <p> برای مشاهده کد فعالسازی ۴ رقم آخر کارت خود را به شماره ۰۹۱۲۶۱۴۵۷۰۵ پیامک
                                        کنید.</p>
                                </div>
                            @endif

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>




@stop

@section('footer')
    @parent
    <script src="{{asset('template/adminto/assets/plugins/morris/morris.min.js')}}"></script>
    <script src="{{asset('template/adminto/assets/plugins/raphael/raphael-min.js')}}"></script>
    <!-- Dashboard init -->
    <script src="{{asset('template/adminto/assets/pages/jquery.dashboard.js')}}"></script>

@endsection

