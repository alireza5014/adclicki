@extends('layouts.material.layout')
@section('header')
    @parent

    <title> ثبت تبلیغ </title>
    <!-- Css files-->
    <link rel="stylesheet" type="text/css" href="{{url('crop/css/style.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('crop/css/style-example.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('crop/css/jquery.Jcrop.css')}}"/>

    <script type="text/javascript" src="{{url('crop/scripts/jquery.Jcrop.js')}}"></script>
    <script type="text/javascript" src="{{url('crop/scripts/jquery.SimpleCropper.js')}}"></script>

@endsection
@section('content')
    <div class="container">


        <div class="card">

            <div class="card-header">

                <p style="float: right"> تبلیغ جدبد </p>
                <a style="float: left" class="btn btn-xs btn-success"
                   href="{{route('user.ads.google_search.list')}}"> لیست تبلیغات گوگل </a>

            </div>
            <div class="card-block">



                <div class="row">

                    <div class="col-md-7">
                        <form class="form-horizontal card" role="form" method="POST"
                              action="{{ route('user.ads.google_search.save') }}">
                            {{ csrf_field() }}


                            <div class="col-sm-12">
                                <div class="form-group form-group--float">
                                    <select onchange="engine(this.value)" id="engine_type" type="text"
                                            class="form-control" name="engine_type">
                                        <option value="1">جستجوی گوگل</option>
                                        <option value="2">جستجوی بینگ</option>


                                    </select>
                                    <label>نوع آگهی </label>
                                    <i class="form-group__bar"></i>

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


                            <div class="col-sm-12">
                                <div class="form-group form-group--float">
                                    <input id="title" type="text" class="form-control" name="title"
                                           value="{{old('title')}}">
                                    <label> عنوان آگهی </label>
                                    <i class="form-group__bar"></i>

                                </div>


                            </div>

                            <div class="col-sm-12">
                                <div class="form-group form-group--float">
                                    <input dir="ltr" id="link" type="text" class="form-control" name="link"
                                           value="{{old('link')}}" placeholder="http://example.com">

                                    <label> لینک سایت </label>
                                    <i class="form-group__bar"></i>

                                </div>


                            </div>

                            <div class="col-sm-12">
                                <div class="form-group form-group--float">
                                    <input id="keyword" type="text" class="form-control" name="keyword"
                                           value="{{old('keyword')}}" placeholder="">
                                    <label><p class=" "> کلمه ای که میخواهید با آن در <span class="engine"> گوگل</span>
                                            جستجو
                                            شوید</p></label>
                                    <i class="form-group__bar"></i>

                                </div>


                            </div>



                            <div class="col-sm-12">
                                <div class="form-group form-group--float">
                                    <select id="page_number" type="text" class="form-control" name="page_number">
                                        {{--<option value="">شماره صفحه</option>--}}
                                        @for($i=1;$i<10;$i++)
                                            <option value="{{$i}}">صفحه {{$i}} </option>

                                        @endfor
                                    </select>

                                    <label>   موقعیت تقریبی صفحه </label>
                                    <i class="form-group__bar"></i>

                                </div>

                                <p class="  ">ابتدا در <span class="engine"> گوگل</span> جستجو کرده سپس شماره
                                    صفحه ای که سایت شما


                                    در آن قرار دارد را وارد کنید</p>
                            </div>



                            <div class="col-sm-12">
                                <div class="form-group form-group--float">
                                    <input dir="ltr" id="daily_click" type="text" class="form-control"
                                           name="daily_click"

                                           value="{{old('daily_click')}}">


                                    <label> محدودیت جستجو روزانه</label>
                                    <i class="form-group__bar"></i>

                                </div>


                            </div>






                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        ثبت آگهی
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-5 ">

                        <div class="card-heading">
                            <p class="pull-left"> مراحل ثبت آگهی جستجو گوگل</p>

                        </div>
                        <div class="card">

                            <ul class="list-group">

                                <li class="list-group-item"> 1 - ثبت تبلیغ</li>
                                <li class="list-group-item"> 2- خرید کلیک به تعداد دلخواه</li>
                                <li class="list-group-item"> 3 - تخصیص تعداد جستجو ها به تبلیغات</li>
                            </ul>
                            <p>

                            <li class="list-group-item"> توجه :</li>
                            <li class="list-group-item"> 1 - بعد از ثبت آگهی جهت نمایش تبلیغ شما برای کاربران حتما باید
                                تبلیغ خود را شارژ کرده و تعداد کلیک های درخواستی را برای آن اختصاص دهید
                            </li>
                            <li class="list-group-item"> 2- کدی که در صفحه لیست تبلیغات گوگل من ، برای تبلیغ شما درج شده
                                را در فوتر سایت خود قرار دهید
                            </li>
                            <li class="list-group-item"> پس تا زمانی که آگهی شارژ نشده باشد و کد مورد نظر در سایت شما
                                قابل مشاهده نباشد برای کاربران سایت قابل مشاهده و کلیک نمی باشد .
                            </li>
                            <li class="list-group-item"> جهت شارژ آگهی بعد از ثبت آگهی از <a
                                        href="{{url('user/payments/buy/click')}}">منوی خرید کلیک</a> مقدار کلیک درخواستی
                                را خریداری و به آگهی خود اختصاص دهید.
                            </li>

                            </p>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>
@stop