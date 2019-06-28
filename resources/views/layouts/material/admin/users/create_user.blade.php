@extends('layouts.material.layout')
@section('header')
    @parent

    <title> کاربر جدید </title>

@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">New user</div>


                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('save_user') }}">
                            {{ csrf_field() }}


                            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">نوع کاربر :</label>

                                <div class="col-md-6">
                                    <select id="type" class="form-control" name="type"
                                            value="{{ old('type') }}">
                                        <option value="0">کاربر عادی</option>
                                        <option value="1">کاربر ویژه</option>
                                    </select>

                                    @component('input_error',['name' => 'type'])@endcomponent

                                </div>
                            </div>



                            <div class="form-group{{ $errors->has('referrer_id') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">کد معرف :</label>

                                <div class="col-md-6">
                                    <input id="referrer_id" type="text" class="form-control" name="referrer_id"
                                           value="{{ old('referrer_id') }}">

                                    @component('input_error',['name' => 'referrer_id'])@endcomponent

                                </div>
                            </div>



                            <div class="form-group{{ $errors->has('fname') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">نام :</label>

                                <div class="col-md-6">
                                    <input id="fname" type="text" class="form-control" name="fname"
                                           value="{{ old('fname') }}">

                                    @component('input_error',['name' => 'fname'])@endcomponent

                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('lname') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">نام خانوادگی :</label>

                                <div class="col-md-6">
                                    <input id="lname" type="text" class="form-control" name="lname"
                                           value="{{ old('lname') }}">

                                    @component('input_error',['name' => 'lname'])@endcomponent

                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('code_melli') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">  کد کاربری (۸ رقم آخر کد ملی) : </label>

                                <div class="col-md-6">
                                    <input id="code_melli" type="number" class="form-control" value="{{ old('code_melli') }}" name="code_melli">

                                    @component('input_error',['name' => 'code_melli'])@endcomponent

                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('main_code_melli') ? ' has-error' : '' }}">
                                <label for="main_code_melli" class="col-md-4 control-label">کد ملی : </label>

                                <div class="col-md-6">
                                    <input id="main_code_melli" type="number" class="form-control" value="{{ old('main_code_melli') }}" name="main_code_melli">

                                    @component('input_error',['name' => 'main_code_melli'])@endcomponent

                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">ایمیل : </label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ old('email') }}">

                                    @component('input_error',['name' => 'email'])@endcomponent

                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                <label for="mobile" class="col-md-4 control-label">موبایل :</label>

                                <div class="col-md-6">
                                    <input id="mobile" type="number" class="form-control" name="mobile"
                                           value="{{ old('mobile') }}">

                                    @component('input_error',['name' => 'mobile'])@endcomponent

                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">گذرواژه :</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password">

                                    @component('input_error',['name' => 'password'])@endcomponent

                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password-confirm" class="col-md-4 control-label">تکرار گذرواژه </label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation">


                                    @component('input_error',['name' => 'password_confirmation'])@endcomponent

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i> ثبت
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop