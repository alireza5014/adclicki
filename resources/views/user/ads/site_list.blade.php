@extends('layouts.adminto.layout')
@section('header')
    @parent

    <title> لیست تبلیغات کلیکی </title>

@endsection
@section('content')

    <div class="row">

        <style>
            .price {
                color: white;
                background: black;
                padding: 3px;
                margin-bottom: 0px;
                border: 1px solid black;
                border-radius: 0px
            }
        </style>

        @component('help',['content'=>
"  <p> نحوه کسب درآمد:<br/> روی آگهی های زیر کلیک کنید و منتظر باشید تا پیام (امتیاز و درآمد این آگهی برای شما  ثبت  شد)نمایش داده شود
            </p>"])@endcomponent

        <div class="col-sm-12">

            @if(sizeof($site_ads)==0)
                <p class="text-center alert alert-info">
                    <br/> تبلیغ برای کلیک وجود ندارد و یا شما تبلیغات امروزتان را انجام داده اید
                    <br/> کاربران گرامی توجه داشته باشید احتمالا تعدادی از آگهی ها توسط ثبت کنندگان غیر فعال می باشد و
                    احتمال دارد در ساعات دیگر برای کلیک فعال شود
                    پس پروفایل خود را در ساعات دیگر نیز بررسی نمائید </p>


            @else
                <h4> لیست تبلیغات کلیکی</h4>

                <div class="card-box">

                    <?php $x = 0?>
                    @foreach($site_ads as $site_ad)
                        @if($site_ad!=null)

                                <a class="col-md-4" id="ads_{{$site_ad->id}}"
                               onclick="visit_ads({{$site_ad->view_request->id}})">
                                <div class="card-box">
                                    <span class="label label-info pull-right"><?php echo ++$x ?></span>
                                    <p>{{$site_ad->title}}</p>
                                    <img src="{{url($site_ad->image_path)}}" class="img img-responsive">
                                    <div class="price">

                                        <div class="col-xs-8">۵ تومان</div>
                                        <span class="col-xs-4"> ۴۰ ثانیه </span>
                                        <span class="clearfix"></span>
                                    </div>
                                </div>
                            </a>


                        @endif

                    @endforeach

                    <div class="clearfix">
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

@stop

