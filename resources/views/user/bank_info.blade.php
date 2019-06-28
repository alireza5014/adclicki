@extends('layouts.adminto.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">  bank info  </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('user.modify.bank_info') }}"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}






                            <div class="form-group{{ $errors->has('fname') ? ' has-error' : '' }}">
                                <label for="fname" class="col-md-4 control-label">نام‌ :  </label>

                                <div class="col-md-6">
                                    <input disabled="" id="fname" type="text" class="form-control" name="fname"
                                           value="{{ $user->fname ." ".$user->lname }}">

                                    @if ($errors->has('fname'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('fname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>






                            <div class="form-group{{ $errors->has('card_number') ? ' has-error' : '' }}">
                                <label for="card_number" class="col-md-3 control-label">شماره کارت :  </label>

                                <div class="col-md-9">
                                    <input dir="ltr" id="card_number" type="text" class="form-control" name="card_number"
                                           value="{{ $user->card_number }}">

                                    @if ($errors->has('card_number'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('card_number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('shaba_number') ? ' has-error' : '' }}">
                                <label for="shaba_number" class="col-md-3 control-label">شماره شبا :  </label>

                                <div class="col-md-9">
                                    <input dir="ltr" id="shaba_number" type="text" class="form-control" name="shaba_number"
                                           value="IR{{ str_replace('IR','',$user->shaba_number) }}">

                                    @if ($errors->has('shaba_number'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('shaba_number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>












                            <div class="form-group">
                                <div class="col-md-9 col-md-offset-3">
                                    <button type="submit" class="btn btn-primary  btn-block">
                                        <i class="fa fa-btn  "></i> ویرایش
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
