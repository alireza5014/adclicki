@extends('layouts.material.layout')



@section('content')
    <div class="card">
        <div class="container">

            <div class="row group">

                <div class="col-sm-6">

                    <p class="alert alert-success">کد تایید به ایمیل شما ارسال شد</p>
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('user.verify') }}"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}


                        <div class="form-group form-group--float">
                            <input dir="ltr" id="price" type="text" class="form-control" name="code"
                                   value="{{old('code')}}">
                            <label> کد تایید </label>
                            <i class="form-group__bar"></i>

                        </div>
                        @if ($errors->has('code'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                        @endif


                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary  btn-block">
                                    <i class="fa fa-btn  "></i> درخواست برداشت از حساب
                                </button>
                            </div>

                        </div>
                    </form>

                </div>
                <div class="col-sm-6">


                    <ul class="list-group">

                        <p class="alert alert-info m-b-5">
                            حداقل مبلغ درخواست برداشت برای بار اول ۲,۰۰۰ تومان می باشد.
                            <br/>
                            حداقل مبلغ درخواست برداشت برای بار دوم ۵,۰۰۰ تومان می باشد.
                            <br/>
                            حداقل مبلغ درخواست برداشت برای بار سوم و به بعد ۱۰,۰۰۰ تومان می باشد.

                        </p>
                        <p class="alert alert-danger m-b-20">
                            شما در هر ۲۴ ساعت یکبار می توانید درخواست واریز وجه کنید.
                        </p>

                        <p class="alert alert-success m-b-20">
                            مبلغ درخواست شده کمتر از ۲۴ ساعت به حساب شما واریز خواهد شد.
                        </p>
                    </ul>

                </div>


            </div>
        </div>
    </div>
@stop
