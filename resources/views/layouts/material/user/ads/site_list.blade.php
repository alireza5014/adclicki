@extends('layouts.material.layout')
@section('header')
    @parent

    <title> لیست تبلیغات کلیکی </title>

@endsection
@section('content')
    @component('help',['content'=>
"  <p> نحوه کسب درآمد:<br/> روی آگهی های زیر کلیک کنید و منتظر باشید تا پیام (امتیاز و درآمد این آگهی برای شما  ثبت  شد)نمایش داده شود
        </p>"])@endcomponent
    <div class="row">


        <div class="card">
            <div class="card-box">
            @if(sizeof($site_ads)==0)
                <p class="text-center alert alert-info">
                    <br/> تبلیغ برای کلیک وجود ندارد و یا شما تبلیغات امروزتان را انجام داده اید
                    <br/> کاربران گرامی توجه داشته باشید احتمالا تعدادی از آگهی ها توسط ثبت کنندگان غیر فعال می باشد و
                    احتمال دارد در ساعات دیگر برای کلیک فعال شود
                    پس پروفایل خود را در ساعات دیگر نیز بررسی نمائید </p>


            @else
                <header class="user__info card">
                    <h2> لیست تبلیغات کلیکی</h2>

                </header>


                    <div class="row">
                        <?php $x = 0?>
                        @foreach($site_ads as $site_ad)
                            @if($site_ad!=null)
                                <a class="col-md-4 col-sm-6" id="ads_{{$site_ad->id}}"
                                   onclick="visit_ads({{$site_ad->view_request->id}})">

                                    <div class="card animation-demo">
                                        <div class="card-header">
                                            <h2 class="card-title">{{$site_ad->title}}  </h2>
                                            {{--<small class="card-subtitle">Click on the buttons below to start the animation</small>--}}
                                        </div>

                                        <div class="card-block">
                                            <img class="animated" src="{{url($site_ad->image_path)}}" width="100%" alt="">

                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <button class="btn btn-secondary">۵ تومان</button>
                                                </div>
                                                <div class="col-sm-3">
                                                    <button class="btn btn-secondary">۴۰ ثانیه</button>
                                                </div>
                                                <div class="col-sm-6">
                                                    <button class="btn btn-primary btn-block">بازدید</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                                </a>




                            @endif

                        @endforeach


                        </div>
                    </div>

                    <script>
                        function visit_ads(id) {
                            $('#ads_' + id).remove();
                            var url = window.location.hostname;
                            window.open('<?php echo "http://" . $_SERVER['HTTP_HOST'] . "/user/visit" ?>/' + id, '_blank');
                            //  window.open('http://'+url+'/user/visit/' + id, '_blank');
                        }
                    </script>
                    @endif

                </div>
        </div>

@stop

