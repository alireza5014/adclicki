@extends('layouts.material.layout')
@section('header')
    @parent

    <title> ویرایش کاربر {{$users->name}} </title>

@endsection
@section('content')
    <div class="col-sm-8 offset-sm-2">
        <link href="{{asset('css/select2.min.css')}}" rel="stylesheet">
        <div class="card">
            <div class="col-md-8 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="card-header">ویرایش کاربر</div>
                    <div class="card-block">
                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ route('modify_user',['id'=>$users->id]) }}">
                            {{ csrf_field() }}


                            <div class="col-sm-12">
                                <div class="form-group form-group--float">
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
                                    <label> نوع کاربر </label>
                                    <i class="form-group__bar"></i>

                                </div>
                                @component('input_error',['name' => 'type'])@endcomponent

                            </div>


                            <div class="col-sm-12">
                                <div class="form-group form-group--float">
                                    <input id="fname" type="text" class="form-control" name="fname"
                                           value="{{ $users->fname }}">
                                    <label> نام </label>
                                    <i class="form-group__bar"></i>

                                </div>
                                @component('input_error',['name' => 'fname'])@endcomponent

                            </div>

                            <div class="col-sm-12">
                                <div class="form-group form-group--float">
                                    <input id="lname" type="text" class="form-control" name="lname"
                                           value="{{ $users->lname  }}">
                                    <label> نام خانوادگی </label>
                                    <i class="form-group__bar"></i>

                                </div>
                                @component('input_error',['name' => 'lname'])@endcomponent

                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-group--float">
                                    <input   id="code_melli" type="number" class="form-control"
                                           value="{{ $users->main_code_melli }}" name="code_melli">

                                    <label> کد ملی </label>
                                    <i class="form-group__bar"></i>

                                </div>
                                @component('input_error',['name' => 'main_code_melli'])@endcomponent

                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-group--float">
                                    <input   id="email" type="email" class="form-control" name="email"
                                           value="{{ $users->email  }}">
                                    <label>ایمیل </label>
                                    <i class="form-group__bar"></i>

                                </div>
                                @component('input_error',['name' => 'email'])@endcomponent

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
                                        <i class="fa fa-btn fa-user"></i> ویرایش کاربر
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
