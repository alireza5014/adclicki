<?php makeAnalyze();

$path=url('template/site1');?>

        <!DOCTYPE html PUBLIC
        "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="fa-IR">
<head>
    @section('head')
        <script src="{{$path}}/template/site/js/jquery.js"></script>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>



        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="publisher" href="https://plus.google.com/YOURIDG+">


        <link rel="shortcut icon" href="{{$path}}/template/site/images/fav.png.ico" type="image/png">

        <link rel="stylesheet" href="{{$path}}/template/site/css/icons.css">
        <link rel="stylesheet" href="{{$path}}/template/site/css/user/login.css">
        <link rel="stylesheet" href="{{$path}}/template/site/css/user/checkbox.css">
        <link rel="stylesheet" href="{{$path}}/template/site/css/user/nice-select.css">
        <link rel="stylesheet" type="text/css" href="{{$path}}/template/site/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{$path}}/template/site/css/style.css">     <link rel="stylesheet" href="{{$path}}/template/site/css/modal.css">

         <!--<script src="template/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>-->
        <script src="{{$path}}/template/core/core.js"></script>

        <!-- Start Alexa Certify Javascript -->
        {{--<script type="text/javascript">--}}
            {{--_atrk_opts = { atrk_acct:"McTzr1WyR620WR", domain:"adclicki.ir",dynamic: true};--}}
            {{--(function() { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://certify-js.alexametrics.com/atrk.js"; var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(as, s); })();--}}
        {{--</script>--}}
        <noscript><img src="https://certify.alexametrics.com/atrk.gif?account=McTzr1WyR620WR" style="display:none" height="1" width="1" alt="" /></noscript>
        <!-- End Alexa Certify Javascript -->
    @show

    <meta name="msvalidate.01" content="D592FB011C73322E0297FA7BB7DD7B01"/>
</head>

<body>


<!-- start modal -->

{{--<input id="toggler" class="modal-toggler" type="checkbox" checked aria-hidden="trues">--}}
{{--<section class="modal-container">--}}
    {{--<label for="toggler" class="modal  close-modal-area"></label>--}}
    {{--<div class="modal  modal-box">--}}
        {{--<div class="modal-box-header">--}}
            {{--<h2>طرح تفخیف عید تا عید</h2>--}}
        {{--</div>--}}
        {{--<div class="modal-box-content">--}}
            {{--<p>ضمن تبریک اعیاد قربان و غدیر ، می توانید با شارژ حداقل 100 هزارتومان و استفاده از کد تخفیف زیر ، از 20 درصد تخفیف ویژه بهره مند شوید.</p>--}}
            {{--<input type="text" name="" value="eid-ta-eid">--}}
            {{--<label for="toggler" class="toggle-modal-button">بستن</label>--}}
            {{--<a href="http://popupaval.com/blog/discount-buy-popup/" target="_black">توضیحات بیشتر</a>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</section>--}}
<!-- end modal  -->



<header>

    <div class="top-header">
        <div class="container clearfix">
            <ul class="top-menu hidden-xs">
                <li> <a href="{{url('ads/tariffs')}}"> تعرفه تبلیغات و درآمد </a> </li>
                <li> <a href="{{url('faq')}}"> سوالات متداول </a> </li>
                <li> <a href="{{url('terms')}}"> قوانین و مقررات</a> </li>
                {{--<li> <a href="blog/index.html" target="blank"> بلاگ</a> </li>--}}
                <li> <a href="{{url('contact_us')}}"> درباره ما </a> </li>
            </ul>



            <div class="login">

                @if(!auth('user')->check())
                    <a class="btn btn-primary" href="{{url('user/register')}}">
                        <span>ثبت نام</span>
                    </a>
                    <a class="btn btn-primary login-header"  href="{{url('login')}}" >
                        <span>ورود</span>
                    </a>

                    <a class="btn btn-primary " style="background: #c1570b" href="{{url('recover_password')}}" >
                        <span>بازیابی رمز عبور</span>
                    </a>
                    @else


                    <span class="icon-profile-male"></span>
                    <div class="dropdown">

                        <div class="user-info" >
                            <span> {{auth('user')->user()->fname." ".auth('user')->user()->lname}}</span>
                            <i class="fa fa-angle-down"></i>
                        </div>
                        <div id="myDropdown" class="dropdown-content">
                            <a href="{{url('user/home')}}" class="">
                                <i class="fa fa-user"></i>
                                <span>پنل کاربری</span>
                            </a>
                            <a href="{{url('user/withdrawals/new')}}">
                                <i class="fa fa-cogs"></i>
                                <span>در خواست واریز موجودی</span>
                            </a>
                            <a href="{{url('user/password')}}">
                                <i class="fa fa-cogs"></i>
                                <span>تغییر کلمه عبور</span>
                            </a>
                            <a href="{{url('user/getLogout')}}">
                                <i class="fa fa-power-off"></i>
                                <span>خروج از پنل</span>
                            </a>
                        </div>
                    </div>

                    @endif

            </div>
        </div>
    </div>
    <div class="container">
        <a  href="{{url('')}}">
            <div class="logo">
                <img title="سیستم تبلیغات پاپ آپ" alt="اد کلیکی" src="{{url('logo.png')}}">
                <h5>سامانه هوشمند اد کلیکی</h5>
            </div>
        </a>
        <div class="services-cat visible-xs visible-sm">
            <div class='toggle-nav' data-target="navbar">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="menu">
            <nav>
                <ul>
                    <li class="active"  > <a href="{{url('')}}"> صفحه اصلی </a> </li>
                    <li><a href="{{url('ads/popup')}}">تبلیغات پاپ آپ</a></li>
                    <li><a href="{{url('ads/search')}}">تبلیغات جستجو گوگل</a></li>
                    <li><a href="{{url('ads/clicki')}}">تبلیغات کلیکی </a></li>
                    <li   ><a href="{{url('payments')}}">اثبات پرداختی ها</a></li>

                </ul>
            </nav>
        </div>
    </div>
</header>

@yield('content')




<footer>
    <div class="container clearfix footer-item ">
        <div class="footer-item span-sm-3 span-xs-12">
            <h6 class="footer-item-title"> <span> خدمات </span> </h6>
            <nav>
                <ul class="footer-item-content">
                    <li> <a href="{{url('ads/popup')}}">تبلیغات پاپ آپ</a></li>
                    <li> <a href="{{url('ads/search')}}">تبلیغات جستجوی گوگل</a></li>
                    <li> <a href="{{url('ads/clicki')}}">تبلیغات کلیکی</a></li>
                    <li> <a href="{{url('payments')}}">  اثبات پرداختی ها</a></li>

                </ul>
            </nav>
        </div>
        <div class="footer-item span-sm-3 span-xs-12">
            <h6 class="footer-item-title"> <span> دیگر صفحات </span> </h6>
            <nav>
                <ul class="footer-item-content">
                    <li> <a href="{{url('ads/tariffs')}}">تعرفه تبلیغات و درآمد </a> </li>
                    <li> <a href="{{url('terms')}}">قوانین و مقررات</a> </li>
                    <li> <a href="{{url('faq')}}">سوالات متداول </a> </li>
                    <li> <a href="{{url('contact_us')}}">درباره ما </a> </li>
                </ul>
            </nav>
        </div>
        <div class="footer-item span-sm-3 span-xs-12">
            <h6 class="footer-item-title"> <span> پشتیبانی </span> </h6>
            <ul class="footer-item-content">
                <li> <p> تهران - دهکده المپیک - مجتمع تجاری اداری گلستان   </p> </li>

                <li><p>تلفن همراه : ۰۹۱۲۶۱۴۵۷۰۵</p> </li>
                <li>
                    <h2><i class="fa fa-share-alt"></i> ما را دنبال کنید</h2>
                </li>
                <li class="social-networks-footer">
                    <ul>

                        <li>
                            <a href="https://www.instagram.com/adclicki/" target="_blank"  ><span class="fa fa-instagram"></span> </a>
                        </li>
                        <li>
                            <a href="https://t.me/adclicki" target="_blank"> <span class="fa fa-telegram"></span> </a>
                        </li>


                        <li>
                            <a href="https://twitter.com/adclicki" target="_blank"> <span class="fa fa-twitter"></span> </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="footer-item span-sm-3 span-xs-12">

        </div>
    </div>
    <div class="copyright">
        <p>تمامی حقوق مادی و معنوی این وب سایت متعلق به شرکت توسعه پردازان رویال می باشد. <a target="_blank" href="" ><span class="designer"> طراحی سایت </span> </a>
            <!-- first code xdev -->
        <div class="inner left" >
            <div align="center" dir="ltr" id="script_license">


                Powered by RoyalWeb &copy;  2013 - 2018</div>			        <!--<div id="site_copy">کلیه حقوق محفوظ است</div>-->
        </div>
        <div class="clearfix"></div>
        <div align="center" id="footer_extra">
        </div>

        <!-- end code xdev -->

        </p>

    </div>
</footer>	<!--</div>-->
</div>

@section('js')

{{--<script src="{{$path}}/template/site/js/jquery.js" ></script>--}}

 {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" ></script> --}}
<script src="{{$path}}/template/site/js/user/scroll.jquery.min.js" ></script>
{{--<script src="{{$path}}/template/site/js/script.js"></script>--}}




<script src="{{$path}}/template/site/js/js/scripts.js"></script>

<script src="{{$path}}/template/site/js/js/particles.js" ></script>
<script src="{{$path}}/template/site/js/user/jquery.nice-select.min.js" ></script>











<script>$(function(){$("select").niceSelect()});
</script>


@show

<script type="text/javascript" src="https://www.adclicki.ir/js/pgk.js"></script>
<a id="demo" href="https://www.adclicki.ir/user/pgk/155">-</a>
<!-- shema-->
{{--<script src="//code.tidio.co/anzdmo7lio9uih04o0xjh6wrzcmhjsee.js"></script>--}}
<script>

    $('.user-info').on('click',function () {
        $('#myDropdown').toggleClass('show');

    })


 </script>
</body>
</html>
</html>


