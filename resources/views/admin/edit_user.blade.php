@extends('layouts.adminto.layout')
@section('header')
    @parent

    <title>     ویرایش کاربر {{$users->name}} </title>

@endsection
@section('content')
    <div class="container">
        <link href="{{asset('css/select2.min.css')}}" rel="stylesheet">
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">ویرایش کاربر  </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('modify_user',['id'=>$users->id]) }}">
                            {{ csrf_field() }}



                            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">نوع کاربر :</label>

                                <div class="col-md-6">
                                    <select id="type" class="form-control" name="type"
                                            >
                                        @if($users->type ==0)
                                            <option value="0">کاربر عادی</option>
                                            <option value="1">کاربر ویژه</option>
                                            @else
                                            <option value="1">کاربر ویژه</option>
                                            <option value="0">کاربر عادی</option>


                                        @endif
                                    </select>

                                    @component('input_error',['name' => 'type'])@endcomponent

                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('fname') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">نام :</label>

                                <div class="col-md-6">
                                    <input id="fname" type="text" class="form-control" name="fname"
                                           value="{{ $users->fname }}">

                                    @component('input_error',['name' => 'fname'])@endcomponent

                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('lname') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">نام خانوادگی :</label>

                                <div class="col-md-6">
                                    <input id="lname" type="text" class="form-control" name="lname"
                                           value="{{ $users->lname  }}">

                                    @component('input_error',['name' => 'lname'])@endcomponent

                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('main_code_melli') ? ' has-error' : '' }}">
                                <label for="code_melli" class="col-md-4 control-label">کد ملی : </label>

                                <div class="col-md-6">
                                    <input disabled id="code_melli" type="number" class="form-control" value="{{ $users->main_code_melli }}" name="code_melli">

                                    @component('input_error',['name' => 'main_code_melli'])@endcomponent

                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">ایمیل : </label>

                                <div class="col-md-6">
                                    <input disabled id="email" type="email" class="form-control" name="email"
                                           value="{{ $users->email  }}">

                                    @component('input_error',['name' => 'email'])@endcomponent

                                </div>
                            </div>




                            {{--<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">--}}
                                {{--<label for="password" class="col-md-4 control-label">گذرواژه :</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="password" type="password" class="form-control" name="password">--}}

                                    {{--@component('input_error',['name' => 'password'])@endcomponent--}}

                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">--}}
                                {{--<label for="password-confirm" class="col-md-4 control-label">تکرار گذرواژه </label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="password-confirm" type="password" class="form-control"--}}
                                           {{--name="password_confirmation">--}}


                                    {{--@component('input_error',['name' => 'password_confirmation'])@endcomponent--}}

                                {{--</div>--}}
                            {{--</div>--}}



                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i>   ویرایش کاربر
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
