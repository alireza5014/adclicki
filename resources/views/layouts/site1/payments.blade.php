@extends('layouts.site1.layout')
@section('head')
    @parent

    <title>اثبات پرداختی سایت اد کلیکی</title>

    <meta name="description" content="اثبات پرداختی سایت اد کلیکی">
    <meta name="keywords"
          content="اثبات پرداختی , اد کلیکی , کسب درآمد از اینترنت , تبلیغات کلیکی , افزایش رتبه الکسا  ">

    <meta name="author" content="علیرضا حیدری">


    <meta property="og:image" content="https://adclicki.ir/adclicki.jpg"
          data-react-helmet="true">
    <meta property="og:image:width" content="1161" data-react-helmet="true">
    <meta property="og:image:height" content="1022" data-react-helmet="true">
    <meta property="twitter:card" content="summary_large_image" data-react-helmet="true">
    <meta property="twitter:site" content="@padclicki_ir" data-react-helmet="true">

    <meta property="twitter:creator" content="@padclicki_ir" data-react-helmet="true">
    <meta property="twitter:description"
          content="اثبات پرداختی سایت اد کلیکی"
          data-react-helmet="true">
    <meta property="twitter:title" content=" اثبات پرداختی سایت اد کلیکی "
          data-react-helmet="true">
    <meta property="og:description"
          content="اثبات پرداختی سایت اد کلیکی"
          data-react-helmet="true">
    <meta property="og:title" content=" اثبات پرداختی سایت اد کلیکی "
          data-react-helmet="true">
    <meta name="description"
          content="اثبات پرداختی سایت اد کلیکی"
          data-react-helmet="true">

@stop

@section('content')
    <main>
        <section class="main " role="main">
            <div class="breadcrumb">
                <a href="../index.html"> <span class="fa fa-home"></span> </a>
                <i class="fa fa-angle-left"></i>
                <span>داشبورد</span>
            </div>
            <div class="main-content" class="span8">
                <div class="row-fluid">
                    <div class="box span12">
                        <div class="title"><h1>اثبات مبالغ پرداختی</h1></div>
                        <div class="body">
                            <div class="box-header">
                                <h2> اثبات پرداختی ها </h2>
                                <span>   لیست پرداخت های سال ۹۸ اد کلیکی</span>
                            </div>
                            <div class="container clearfix">
                                <div class="orders-table">
                                    <div class="orders-table-body">
                                        <table class="table table-bordered table-striped counter" width="100%"
                                               cellpadding="0" cellspacing="0">
                                            <thead>
                                            <tr>

                                                <th>##</th>
                                                <th>نام و نام خانوادگی</th>

                                                <th> ایمیل</th>
                                                <th> IP</th>
                                                <th> مبلغ درخواستی(تومان)</th>


                                                <th> زمان درخواست</th>
                                                <th> زمان پرداخت</th>
                                                {{--<th> رسید</th>--}}


                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($payments as $payment)
                                                <tr>
                                                    <td></td>
                                                    <td>{{$payment->user->fname}}</td>
                                                    <td>{{str_replace(substr($payment->user->email,2,8),'****',$payment->user->email)}}
                                                    <td dir="ltr"
                                                        style="text-align: center!important;">{{str_replace(substr($payment->user->ip,3,6),'****',$payment->user->ip)}}

                                                    </td>

                                                    <td>{{number_format($payment->price)}}</td>
                                                    <td>{{$payment->created_at}}</td>
                                                    <td>{{$payment->updated_at}}</td>
                                                    {{--<td><a href="{{url($payment->image_path)}}" target="_blank"><img--}}
                                                    {{--src="{{url('resid.jpg')}}" width="50px"/></a></td>--}}

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                        {{$payments->appends($_GET)->links()}}

                    </div>
                </div>
                <div class="row-fluid" id="inline_load" style="display: none;"></div>
            </div>
        </section>
    </main>



@endsection