@extends('layouts.adminto.layout')
@section('header')
    @parent

    <title> ویرایش وب هوک </title>
    <!-- Css files-->
    <link rel="stylesheet" type="text/css" href="{{url('crop/css/style.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('crop/css/style-example.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('crop/css/jquery.Jcrop.css')}}"/>

    <script type="text/javascript" src="{{url('crop/scripts/jquery.Jcrop.js')}}"></script>
    <script type="text/javascript" src="{{url('crop/scripts/jquery.SimpleCropper.js')}}"></script>

@endsection
@section('content')
    <div class="container">


        <div class="row">

            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p class="pull-left"> تبلیغ جدبد </p>
                        <a class="pull-right btn btn-xs btn-success" href="{{route('user.ads.clicki.list')}}"> لیست
                            تبلیغات </a>
                        <div class="clearfix"></div>
                    </div>


                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('user.ads.modify') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{$ads->id}}">
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-2 control-label"> عنوان آگهی : </label>

                                <div class="col-md-9">
                                    <input id="title" type="text" class="form-control" name="title"
                                           value="{{$ads->title}}">


                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-2 control-label">لینک سایت : </label>

                                <div class="col-md-9">
                                    <input id="old_link" type="hidden" class="form-control" name="old_link"
                                           value="{{$ads->link}}"  >
                                    <input dir="ltr" id="link" type="text" class="form-control" name="link"
                                           value="{{$ads->link}}" placeholder="http://example.com">


                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('daily_click') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-2 control-label"> محدودیت کلیک روزانه : </label>

                                <div class="col-md-4">
                                    <input dir="ltr" id="daily_click" type="text" class="form-control"
                                           name="daily_click"
                                           value="{{$ads->daily_click}}">


                                </div>
                                <div class="col-md-5">
                                    <p>حداقل ۵۰۰ کلیک</p>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('main_image') ? ' has-error' : '' }}">

                                <a class="control-label">

                                    <label class="col-sm-2 control-label"> تصویر بنر : </label>

                                    <div class=" col-md-9">

                                        <div class="card-box text-center active" id="form_image_preview">
                                            <img src="{{url($ads->image_path)}}" width="100%" height="60px">


                                        </div>

                                        <textarea style="display: none;" id="main_image"
                                                  name="main_image">{{encodeImageToBase64(url($ads->image_path))}}</textarea>

                                    </div>

                                </a>


                                <script>
                                    // Init Simple Cropper
                                    $('#form_image_preview').simpleCropper(468, 60, 280, 45);
                                </script>

                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-info btn-block">
                                        ویرایش آگهی
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@stop