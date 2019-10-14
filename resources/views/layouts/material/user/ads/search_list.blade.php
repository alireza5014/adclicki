@extends('layouts.material.layout')
@section('header')
    @parent

    <title> 1لیست تبلیغات سرچ گوگل</title>

@endsection
@section('content')
    @component('help',['content'=>
"  <p> نحوه کسب درآمد:<br/>  پس از کلیک بر روی دکمه بازدید، سایت نمایش داده شده را در $my_engine پیدا کرده و بر روی آدرس آن کلیک کنید
و حدود 10 ثانیه صبر کنید تا لینک (ثبت امتیاز تبلیغ) در قسمت فوتر (انتهای سایت)فعال شود و روی آن کلیک کنید تا امتیاز برای شما ثبت شود </p>"])@endcomponent


    <div class="row">


        <div class="col-sm-12">

            @if(sizeof($search_ads)==0)
                <p class="text-center alert alert-info">
                    <br/> تبلیغ برای کلیک وجود ندارد و یا شما تبلیغات امروزتان را انجام داده اید
                    <br/> کاربران گرامی توجه داشته باشید احتمالا تعدادی از آگهی ها توسط ثبت کنندگان غیر فعال می باشد و
                    احتمال دارد در ساعات دیگر برای کلیک فعال شود
                    پس پروفایل خود را در ساعات دیگر نیز بررسی نمائید </p>


            @else
                <h4> لیست تبلیغات جستجوی {{$my_engine}}</h4>

                <div class="card">
                    <div class="row">

                        @foreach($search_ads as $google_search_ad)
                            @if($google_search_ad!=null)

                                <div class="col-md-3">

                                    <a class="col-md-12" id="ads_{{$google_search_ad->id}}"
                                       style="">

                                        <div class="card">
                                            <div class="col-md-12">
                                                <p>{{$google_search_ad->title}}</p>
                                                <img class="animated img-responsive" src="{{url('/images/website/'.str_replace(array('http://', 'https://'), array('', ''), rtrim($google_search_ad->link, "/ ")).".png")}}" width="100%"  alt="">

                                                <a
                                                        onclick="search_ads(<?php echo $google_search_ad->id?>,'{{$google_search_ad->google_search->keyword}}')"
                                                        class="btn btn-success text-white " style="width: 100%"> بازدید و کسب درآمد</a>
                                            </div>

                                            <div class="col-md-12">
                                                <p>
                                                    آدرس سایت
                                                    <br/>
                                                    {{$google_search_ad->link}}
                                                    <br/>
                                                    را حدودا در صفحه
                                                    <code>{{$google_search_ad->google_search->page_number}}</code>
                                                    {{$my_engine}}
                                                    پیدا کنید
                                                    و کلیک کنید.
                                                    <br/>
                                                    و در قسمت فوتر سایت روی <span
                                                            class="text-warning">( ثبت امتیاز تبلیغ )</span> کلیک کنید.
                                                </p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>


                                    </a>
                                    </a>
                                    <div class="clearfix"></div>

                                </div>

                            @endif

                        @endforeach
                    </div>
                    <div class="clearfix">
                    </div>
                </div>

                <script>
                    function search_ads(id, keyword) {
                        $('#ads_' + id).remove();
                        window.open('{{$url}}' + keyword, '_blank');
                    }


                </script>
            @endif

        </div>
    </div>
@stop



