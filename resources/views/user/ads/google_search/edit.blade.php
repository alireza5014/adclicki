@extends('layouts.adminto.layout')
@section('header')
    @parent

    <title> ویرایش وب هوک </title>
    <!-- Css files-->
    <page_number rel="stylesheet" type="text/css" href="{{url('crop/css/style.css')}}"/>
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
                        <p class="pull-left"> ویرایش تبلیغ   </p>
                        <a class="pull-right btn btn-xs btn-success" href="{{route('user.ads.google_search.list')}}">
                            لیست تبلیغات جستجو گوگل </a>
                        <div class="clearfix"></div>
                    </div>


                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('user.ads.google_search.modify') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{$ads->id}}">

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-3 control-label"> نوع آگهی : </label>

                                <div class="col-md-9">
                                    <select onchange="engine(this.value)" id="engine_type" type="text"
                                            class="form-control" name="engine_type">
                                        <option @if($ads->type==1) selected @endif value="1">جستجوی گوگل</option>
                                        <option  @if($ads->type==2) selected @endif  value="2">جستجوی بینگ</option>


                                    </select>


                                </div>
                            </div>
                            <script>
                                function engine(engine) {

                                    switch (engine) {
                                        case "1":

                                            $('span.engine').text('گوگل');

                                            break;
                                        case "2":
                                            $('span.engine').text('بینگ');

                                            break;
                                    }
                                }
                            </script>

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-3 control-label"> عنوان آگهی : </label>

                                <div class="col-md-9">
                                    <input id="title" type="text" class="form-control" name="title"
                                           value="{{$ads->title}}">


                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">لینک سایت : </label>

                                <div class="col-md-9">
                                    <input   id="old_link" type="hidden" class="form-control" name="old_link"
                                           value="{{$ads->link}}"  >
                                    <input dir="ltr" id="link" type="text" class="form-control" name="link"
                                           value="{{$ads->link}}" placeholder="http://example.com">


                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('keyword') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">کلیدواژه : </label>

                                <div class="col-md-9">
                                    <input id="keyword" type="text" class="form-control" name="keyword"
                                           value="{{$ads->google_search->keyword}}" placeholder="">
                                    <p class="error"> کلمه ای که میخواهید با آن در <span class="engine"> گوگل</span> جستجو شوید</p>


                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('page_number') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label"> موقعیت تقریبی صفحه: </label>

                                <div class="col-md-3">
                                    <select id="page_number" type="text" class="form-control" name="page_number">

                                        @for($i=1;$i<10;$i++)
                                            <option
                                                    @if($ads->google_search->page_number==$i) selected
                                                    @endif
                                                    value="{{$i}}">صفحه {{$i}} </option>

                                        @endfor


                                    </select>


                                </div>

                                <p class="error col-md-6">ابتدا در <span class="engine"> گوگل</span> جستجو کرده سپس شماره صفحه ای که سایت شما


                                    در آن قرار دارد را وارد کنید</p>
                            </div>
                            <div class="form-group{{ $errors->has('daily_click') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label"> محدودیت کلیک روزانه : </label>

                                <div class="col-md-2">
                                    <input dir="ltr" id="daily_click" type="text" class="form-control"
                                           name="daily_click"

                                           value="{{$ads->daily_click}}">


                                </div>
                                <div class="col-md-5">
                                    <p class="error">حداقل ۵۰۰ کلیک</p>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('main_image') ? ' has-error' : '' }}">


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