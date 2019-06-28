@extends('layouts.material.layout')

@section('content')
    <div class="container">
        <div class="card">

            <div class="card-block">
                <div class="card-header"> bank info</div>

                <form class="form-horizontal" role="form" method="POST" action="{{ route('user.modify.bank_info') }}"
                      enctype="multipart/form-data">
                    {{ csrf_field() }}


                    <div class="row">

                        <div class="col-md-6 offset-3">
                            <div class="form-group">

                                <input disabled="" id="fname" type="text" class="form-control" name="fname"
                                       value="{{ $user->fname ." ".$user->lname }}">


                            </div>
                        </div>


                        <div class="col-sm-6">

                            <div class="form-group form-group--float ">
                                <input id="card_number" type="text" class="form-control" name="card_number"
                                       value="{{$user->card_number}}">


                                <label> شماره کارت </label>

                            </div>

                            @if ($errors->has('card_number'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('card_number') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="col-sm-6">

                            <div class="form-group form-group--float ">
                                <input id="shaba_number" type="text" class="form-control" name="shaba_number"
                                       value="{{$user->shaba_number}}">


                                <label> شماره شبا </label>

                            </div>

                            @if ($errors->has('shaba_number'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('shaba_number') }}</strong>
                                    </span>
                            @endif
                        </div>

                    </div>



                    <div class="form-group">
                        <div class="col-md-6 offset-3 col-md-offset-3">
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
