@extends('layouts.site.layout')
@section('head')
    @parent

    <title>اثبات پرداختی سایت اد کلیکی</title>


    <meta name="description" content="اثبات پرداختی سایت اد کلیکی">
    <meta name="keywords" content="اثبات پرداختی , اد کلیکی , کسب درآمد ار اینترنت , تبلیغات کلیکی , افزایش رتبه الکسا  ">
    
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
    <div class="fullsite">
        <div class="wrapper">
            <div id="header">


                <div class="sub_page_background">
                    <div class="container">
                        <div class="sub_page_backgroundInner row">

                            <!-- Content -->


                            <!-- Content -->
                            <div class="site_title"> لیست پرداخت های سال ۹۸ اد کلیکی</div>
                            <div class="site_content">


                                <h3>
                                    لیست پرداخت های سال ۹۸  اد کلیکی
                                </h3>

                                <style>
                                    tr th {
                                        text-align: right !important;
                                    }
                                </style>
                                <div id="table_data">
                                    <div class="table-responsive" data-pattern="priority-columns">

                                        <table id="tech-companies-1" class="table  table-striped">
                                            <thead>
                                            <tr>

                                                <th>#</th>
                                                <th>نام و نام خانوادگی</th>

                                                <th> ایمیل</th>
                                                <th> IP</th>
                                                <th>  مبلغ درخواستی(تومان)</th>


                                                <th> زمان درخواست</th>
                                                <th> زمان پرداخت</th>
                                                <th> resid</th>


                                            </tr>
                                            </thead>

                                            <tbody>
                                            <?php $x = 0; ?>
                                            @foreach($payments as $payment)
                                                <tr>
                                                    <td>{{++$x}}</td>
                                                    <td>{{$payment->user->fname." ".$payment->user->lname}}</td>
                                                    <td>{{str_replace(substr($payment->email,3,7),'****',$payment->user->email)}}
                                                    <td dir="ltr" style="text-align: center!important;">{{str_replace(substr($payment->user->ip,3,6),'****',$payment->user->ip)}}

                                                    </td>

                                                    <td>{{number_format($payment->price)}}</td>
                                                    <td>{{$payment->created_at}}</td>
                                                    <td>{{$payment->updated_at}}</td>
                                                    <td><a href="{{url($payment->image_path)}}" target="_blank"><img src="{{url('resid.jpg')}}" width="50px"/></a> </td>

                                                </tr>
                                            @endforeach
                                            </tbody>

                                        </table>

                                    </div> <!-- end Container -->
                                    {{$payments->appends($_GET)->links()}}


                                </div> <!-- end footerContainer -->



    @include('notification')


@endsection