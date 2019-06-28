@extends('layouts.adminto.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">پروفایل من</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ route('user_modify_profile') }}"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}


                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">ایمیل : </label>

                                <div class="col-md-6">

                                    <input disabled="" id="email" type="email" class="form-control" name="email"
                                           value="{{ $user->email }}">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-4" for="activity_type"> نوع فعالیت :</label>
                                <div class="col-sm-6">
                                    <select class="form-control" id="activity_type" name="activity_type">

                                        <option @if($user->activity_type==0) selected @endif value="0">بازدید کننده
                                            تبلیغ (کسب درآمد از بازدید تبلیغ)
                                        </option>
                                        <option @if($user->activity_type==1) selected @endif value="1">ثبت کننده تبلیغ
                                            (بهبود رتبه گوگل و الکسا)
                                        </option>
                                        <option @if($user->activity_type==2) selected @endif value="2">هر دو</option>

                                    </select>
                                    <p id="activity_type_error" class="text-danger"></p>

                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('fname') ? ' has-error' : '' }}">
                                <label for="fname" class="col-md-4 control-label">نام‌ : </label>

                                <div class="col-md-6">
                                    <input id="fname" type="text" class="form-control" name="fname"
                                           value="{{ $user->fname }}">

                                    @if ($errors->has('fname'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('fname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('lname') ? ' has-error' : '' }}">
                                <label for="lname" class="col-md-4 control-label">نام خانوادگی : </label>

                                <div class="col-md-6">
                                    <input id="lname" type="text" class="form-control" name="lname"
                                           value="{{ $user->lname }}">

                                    @if ($errors->has('lname'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('lname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                <label for="mobile" class="col-md-4 control-label"> موبایل : </label>

                                <div class="col-md-6">
                                    <input id="mobile" type="text" class="form-control" name="mobile"
                                           value="{{ $user->mobile }}">

                                    @if ($errors->has('mobile'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('code_melli') ? ' has-error' : '' }}">
                                <label for="code_melli" class="col-md-4 control-label">کد ملی : </label>

                                <div class="col-md-6">
                                    <input id="code_melli" type="text" class="form-control" name="code_melli"
                                           value="{{ $user->code_melli }}">

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
        </div>
    </div>
@stop
