@extends('layouts.material.layout')



@section('content')
    <div class="card">
        <div class="container">

            <div class="row group">

                <div class="col-sm-6 offset-3">

                    <p class="text-danger">کد تایید به ایمیل شما ارسال شد </p>
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('user.verify') }}"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}


                        <div class="form-group form-group--float">
                            <input dir="ltr" id="price" type="text" class="form-control" name="code"
                                   value="{{old('code')}}">
                            <label> کد تایید را وارد کنید </label>
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


            </div>
        </div>
    </div>
@stop
