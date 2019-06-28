@extends('layouts.material.layout')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-block">

                    <div class="card-header">تغییر گذرواژه  </div>

                        <form class="form-horizontal" role="form" method="POST" action="{{ route('user.change_password') }}"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}



                            <div class="row">
                                <div class="col-sm-6">

                                    <div class="form-group form-group--float ">
                                        <input id="password" type="password" class="form-control" name="password"
                                               value="">


                                        <label> گذرواژه </label>

                                    </div>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>


                                <div class="col-sm-6">

                                    <div class="form-group form-group--float ">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                               value="">


                                        <label> تکرار گذرواژه </label>

                                    </div>


                                </div>
                            </div>










                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i> تغییر کذرواژه
                                    </button>
                                </div>

                            </div>
                        </form>


            </div>
        </div>
    </div>
@stop
