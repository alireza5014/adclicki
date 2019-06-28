@extends('layouts.site.layout')
@section('head')
    @parent

    <title>سوالات متداول کاربران در مورد نحوه کارکرد سایت اد کلیکی</title>


    <meta name="description" content="سوالات متداول کاربران در مورد نحوه کارکرد سایت اد کلیکی">
    <meta name="keywords" content="سوالات متداول , اد کلیکی , کسب درآمد ار اینترنت , تبلیغات کلیکی , افزایش رتبه الکسا  ">
    
    <meta name="author" content="علیرضا حیدری">
 

    <meta property="og:image" content="https://adclicki.ir/adclicki.jpg"
          data-react-helmet="true">
    <meta property="og:image:width" content="1161" data-react-helmet="true">
    <meta property="og:image:height" content="1022" data-react-helmet="true">
    <meta property="twitter:card" content="summary_large_image" data-react-helmet="true">
    <meta property="twitter:site" content="@padclicki_ir" data-react-helmet="true">

    <meta property="twitter:creator" content="@padclicki_ir" data-react-helmet="true">
    <meta property="twitter:description"
          content="سوالات متداول کاربران در مورد نحوه کارکرد سایت اد کلیکی"
          data-react-helmet="true">
    <meta property="twitter:title" content=" سوالات متداول کاربران در مورد نحوه کارکرد سایت اد کلیکی "
          data-react-helmet="true">
    <meta property="og:description"
          content="سوالات متداول کاربران در مورد نحوه کارکرد سایت اد کلیکی"
          data-react-helmet="true">
    <meta property="og:title" content=" سوالات متداول کاربران در مورد نحوه کارکرد سایت اد کلیکی "
          data-react-helmet="true">
    <meta name="description"
          content="سوالات متداول کاربران در مورد نحوه کارکرد سایت اد کلیکی"
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



                            <script type="text/javascript">
                                $(document).ready(function(){
                                    $(".faq_question").click(function(){
                                        $(this).children('.caret').toggleClass("caretActive");
                                        $(this).parent().children(".faq_answer").slideToggle({height:"0"},2000);
                                    });
                                });
                            </script>

                            <!-- Content -->
                            <div class="site_title">پرسش و پاسخ های متداول</div>
                            <div class="site_content">

                                <div class="faq_num">1</div>
                                <div class="faq">
                                    <div class="faq_question">
                                        تبلیغات کلیکی چیست؟ چگونه باید کار کرد؟
                                    </div>
                                    <div class="faq_answer" style="display: block">
                                        <p> اد کلیکی یک وبسایت بر پایه تبلیغات کلیکی میباشد که محیطی را فراهم میکند تا واسط معتبر میان آگهی دهندگان و بینندگان آگهی ها (کاربران عادی) باشد. یعنی ما آگهی را دریافت میکنیم و بین کاربران به اشتراک گذاشته و مبلغی که از آگهی دهنده دریافت کردیم را بین کاربرانی که آگهی را تماشا کرده اند تقسیم میکنیم.</p>
                                        <p>شما در این وبسایت میتوانید روزانه وارد حساب کاربری خود شوید و رویه آگهی ها کلیک کنید و درآمد کسب نمایید. جهت کسب درآمد بیشتر امکانات بیشتری در سایت قرار داده شده است که میتوانید از آنها نیز استفاده نمایید.</p>
                                    </div>
                                </div>
                                <div class="faq_num">2</div>
                                <div class="faq">
                                    <div class="faq_question">
                                        زیرمجموعه چیست و چگونه میتوان زیرمجموعه داشت؟
                                    </div>
                                    <div class="faq_answer" style="display: block">
                                        <p><strong>زیرمجموعه ها به کاربرانی گفته میشود که از طریق لینک دعوت شما در سایت ثبت نام کرده باشند</strong>. به این صورت این افراد زیر مجموعه و تحت سرپرستی شما قرار میگیرند و میتوانید آنها را از طریق پیام خصوصی راهنمایی کنید تا درآمد بیشتری داشته باشند همچنین درصدی از فعالیت زیرمجموعه ها به عنوان پاداش معرفی سایت به شما تعلق خواهد گرفت که میتوانید این میزان را در بخش ارتقاء حساب کاربری مشاهده نمایید.</p>
                                        <p>در وبسایتهای تبلیغات کلیکی فعالیت زیرمجموعه ها بسیار حیاتی و مهم خواهد بود حتما سعی کنید تبلیغات مناسب جهت کسب زیرمجموعه بیشتر را داشته باشید. از طریق ارسال لینک عضویت مخصوص خود از دوستان و آشنایان و بازدیدکنندگان تبلیغات یا وبلاگ خود بخواهید در سایت ما فعالیت خود را آغاز نمایند.</p>
                                    </div>
                                </div>

                            </div>
                            <!-- End Content -->
                        </div>
                    </div>
                </div>
                <br />

                </div> <!-- end Container -->




            </div> <!-- end footerContainer -->



    @include('notification')


@endsection