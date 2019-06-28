@extends('layouts.site.layout')
@section('head')
    @parent

    <title>لیست کاربران سایت اد کلیکی</title>


    <meta name="description" content=" لیست کاربران سایت اد کلیکی">
    <meta name="keywords"
          content="لیست کاربران , اد کلیکی , کسب درآمد ار اینترنت , تبلیغات کلیکی , افزایش رتبه الکسا  ">

    <meta name="author" content="علیرضا حیدری">


    <meta property="og:image" content="https://adclicki.ir/adclicki.jpg"
          data-react-helmet="true">
    <meta property="og:image:width" content="1161" data-react-helmet="true">
    <meta property="og:image:height" content="1022" data-react-helmet="true">
    <meta property="twitter:card" content="summary_large_image" data-react-helmet="true">
    <meta property="twitter:site" content="@padclicki_ir" data-react-helmet="true">

    <meta property="twitter:creator" content="@padclicki_ir" data-react-helmet="true">
    <meta property="twitter:description"
          content="لیست کاربران سایت اد کلیکی"
          data-react-helmet="true">
    <meta property="twitter:title" content=" لیست کاربران سایت اد کلیکی "
          data-react-helmet="true">
    <meta property="og:description"
          content="لیست کاربران سایت اد کلیکی"
          data-react-helmet="true">
    <meta property="og:title" content=" لیست کاربران سایت اد کلیکی "
          data-react-helmet="true">
    <meta name="description"
          content="لیست کاربران سایت اد کلیکی"
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
                            <div class="site_title"> لیست کاربران اد کلیکی</div>
                            <div class="site_content">


                                <h3>
                                    لیست ۵۰۰ کاربر اخیر اد کلیکی
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
                                                <th>سیستم عامل</th>
                                                {{--<th>بازدیدها</th>--}}
                                                <th> تعداد زیر مجموعه ها</th>
                                                <th> کشور</th>

                                                <th> زمان عضویت</th>


                                            </tr>
                                            </thead>

                                            <tbody>
                                            <?php $x = 0; ?>
                                            @foreach($users as $user)
                                                <tr >
                                                    <td>{{++$x}}</td>
                                                    <td>{{$user->fname." ".$user->lname}}</td>
                                                    <td>{{str_replace(substr($user->email,3,7),'****',$user->email)}}
                                                    <td dir="ltr" style="text-align: center!important;">{{str_replace(substr($user->ip,3,6),'****',$user->ip)}}

                                                    </td>
                                                    <td>{{$user->device}}</td>
{{--                                                    <td>{{$user->visited_links_count}}</td>--}}
                                                    <td>{{$user->referers_count}}</td>
                                                    <td @if($user->country!='Iran') style="background-color: #f02f3f;color: white" @endif>{{$user->country}}</td>
                                                    <td>{{$user->created_at}}</td>

                                                </tr>
                                            @endforeach
                                            </tbody>

                                        </table>

                                    </div> <!-- end Container -->
                                    {{$users->appends($_GET)->links()}}


                                </div> <!-- end footerContainer -->



    @include('notification')


@endsection