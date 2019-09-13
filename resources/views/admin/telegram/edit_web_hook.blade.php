@extends('layouts.adminto.layout')
@section('header')
    @parent

    <title> ویرایش وب هوک 2</title>

@endsection
@section('content')
    <div class="container">



        <div class="row">
            @if($errors->any())
                <div class="alert alert-danger">
                    <p>{{$errors->first()}}</p>

                </div>        @endif
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit WebHook</div>


                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="GET" action="{{ route('web_hook.modify') }}">
                            {{--{{ csrf_field() }}--}}


                            <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-2 control-label">Url </label>

                                <div class="col-md-10">
                                    <input dir="ltr" id="url" type="text" class="form-control" name="url"
                                           value="{{ url('') }}">

                                    @component('input_error',['name' => 'url'])@endcomponent

                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('token') ? ' has-error' : '' }}">
                                <label for="token" class="col-md-2 control-label"> Bot Token </label>

                                <div class="col-md-10">
                                    <input dir="ltr" id="token" type="text" class="form-control" name="token"
                                           value="640316721:AAE_C1Ge-Pi9npRlQEi5k1IgPj2Jsp16KlM">

                                    @component('input_error',['name' => 'token'])@endcomponent

                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i> Edit
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