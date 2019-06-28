@extends('layouts.adminto.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card-box">

            <div class="col-md-6 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading"> درخواست برداشت</div>
                    <div class="panel-body">

                        <form class="form-horizontal" role="form" method="POST" action="{{ route('user.withdrawal') }}"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                <label for="price" class="col-md-3 control-label">مبلغ (تومان) :  </label>

                                <div class="col-md-9">
                                    <input dir="ltr" id="price" type="text" class="form-control" name="price"
                                           value="{{old('price')}}">

                                    @if ($errors->has('price'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-3 control-label">   توضیحات :  </label>

                                <div class="col-md-9">
                                   <textarea class="form-control" name="description" >{{old('description')}}</textarea>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>




                            <div class="form-group">
                                <div class="col-md-9 col-md-offset-3">
                                    <button type="submit" class="btn btn-primary  btn-block">
                                        <i class="fa fa-btn  "></i> درخواست برداشت از حساب
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6" >
                <div class="panel panel-info">
                    <div class="panel-heading"> راهنمای برداشت</div>




                    <div class="panel-body">

                        <ul class="list-group">

                           <p class="alert alert-info m-b-5">
                                    حداقل مبلغ برای درخواست برداشت ۵,۰۰۰ تومان می باشد.
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
                <div class="clearfix"></div>

        </div>
         </div>
    </div>
@stop
