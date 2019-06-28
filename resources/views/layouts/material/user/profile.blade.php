@extends('layouts.material.layout')

@section('content')




    <div class="container">
        <div class="card">

            <div class="card-block">


                <div class="card-header">پروفایل من</div>


                <form class="form-horizontal" role="form" method="POST"
                      action="{{ route('user_modify_profile') }}"
                      enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group form-group--float">
                                <input disabled="" dir="ltr" id="email" type="text" class="form-control" name="email"
                                       value="{{ $user->email }}">
                                <label> ایمیل </label>
                                <i class="form-group__bar"></i>

                            </div>

                        </div>


                        <div class="col-sm-6">

                            <div class="form-group form-group--float ">
                                <select class="form-control" id="activity_type" name="activity_type">

                                    <option @if($user->activity_type==0) selected @endif value="0">بازدید کننده
                                        تبلیغ (کسب درآمد از بازدید تبلیغ)
                                    </option>
                                    <option @if($user->activity_type==1) selected @endif value="1">ثبت کننده تبلیغ
                                        (بهبود رتبه گوگل و الکسا)
                                    </option>
                                    <option @if($user->activity_type==2) selected @endif value="2">هر دو</option>

                                </select>

                                <label> نوع فعالیت </label>
                                <i class="form-group__bar"></i>

                            </div>
                        </div>
                        <div class="col-sm-6">

                            <div class="form-group form-group--float ">
                                <input id="fname" type="text" class="form-control" name="fname"
                                       value="{{ $user->fname }}">


                                <label> نام‌ </label>

                            </div>
                            @if ($errors->has('fname'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('fname') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="col-sm-6">

                            <div class="form-group form-group--float ">
                                <input id="lname" type="text" class="form-control" name="lname"
                                       value="{{ $user->lname }}">


                                <label> نام خانوادگی </label>

                            </div>
                            @if ($errors->has('lname'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('lname') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="col-sm-6">

                            <div class="form-group form-group--float ">
                                <input dir="ltr" id="mobile" type="text" class="form-control" name="mobile"
                                       value="{{$user->mobile}}">
                                <label> موبایل </label>
                                <i class="form-group__bar"></i>

                            </div>
                            @if ($errors->has('mobile'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="col-sm-6">

                            <div class="form-group form-group--float ">
                                <input id="code_melli" type="text" class="form-control" name="code_melli"
                                       value="{{ $user->code_melli }}">


                                <label> کد ملی </label>

                            </div>
                            @if ($errors->has('code_melli'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('code_melli') }}</strong>
                                    </span>
                            @endif
                        </div>


                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-user"></i> ویرایش
                            </button>
                        </div>

                    </div>
                </form>
            </div>

        </div>
    </div>
@stop
