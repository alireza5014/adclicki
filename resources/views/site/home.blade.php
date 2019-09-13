 @extends('layouts.site1.layout')
@section('head')
    @parent

    <title>کاهش رتبه الکسا | افزایش رتبه گوگل |افزایش بازدید سایت</title>


    <meta name="keywords" content="{{$setting->key_word}}">
    <meta name="description" content="{{$setting->description}}">

    <meta name="author" content="{{$setting->author}}">


    <meta property="og:image" content="https://adclicki.ir/adclicki.jpg"
          data-react-helmet="true">
    <meta property="og:image:width" content="1161" data-react-helmet="true">
    <meta property="og:image:height" content="1022" data-react-helmet="true">
    <meta property="twitter:card" content="summary_large_image" data-react-helmet="true">
    <meta property="twitter:site" content="@padclicki_ir" data-react-helmet="true">

    <meta property="twitter:creator" content="@padclicki_ir" data-react-helmet="true">
    <meta property="twitter:description"
          content="{{$setting->description}}"
          data-react-helmet="true">
    <meta property="twitter:title" content=" بازدید سایت رو خیلی راحت بالا ببر و بیا صفحه اول گوگل. افزایش رتبه گوگل و کاهش رتبه الکسا صد در صد تضمینی   "
          data-react-helmet="true">
    <meta property="og:description"
          content="{{$setting->description}}"
          data-react-helmet="true">
    <meta property="og:title" content=" بازدید سایت رو خیلی راحت بالا ببر و بیا صفحه اول گوگل. افزایش رتبه گوگل و کاهش رتبه الکسا صد در صد تضمینی   "
          data-react-helmet="true">
    <meta name="description"
          content="{{$setting->description}}"
          data-react-helmet="true">



@stop

@section('content')

    <div class="bannerTopContainer">
        <div class="container">
            <div class="bannerTopInner row">
                <div class="bannerTop">
                    قویترین وبسایت تبلیغات کلیکی ایران
                </div>
            </div><!-- end bannerTopInner -->
        </div><!-- end container-->
    </div><!-- end bannerTopContainer -->
    <div class="bannerBotContainer">
        <div class="container">
            <div class="bannerBotInner row">
                <div class="bannerBot">
                    <div class="bannerText col-md-6 col-xs-12 ">
                        <ul>
                            <li class="li1">

                                <div class="col-sm-9 col-xs-9">کسب درآمد حلال از آسان ترین و بهترین روش های
                                    تبلیغاتی کلیکی در ایران
                                </div>
                                <div class="col-sm-3 col-xs-3"><img
                                            src="{{url("template/site/styles/images/banner_icon1.png")}}"></div>
                            </li>
                            <li class="li2">

                                <div class="col-sm-9 col-xs-9">کسب درآمد دائمی از زیرمجموعه های خود با معرفی ما
                                    به دوستان خود در سراسر ایران
                                </div>
                                <div class="col-sm-3 col-xs-3"><img
                                            src="{{url("template/site/styles/images/banner_icon2.png")}}"></div>
                            </li>
                            <li class="li3">

                                <div class="col-sm-9 col-xs-9">طراحی واکنش گرا و محیط کاربری آسان و مدیریت همه
                                    اطلاعات با یک کلیک
                                </div>
                                <div class="col-sm-3 col-xs-3"><img
                                            src="{{url("template/site/styles/images/banner_icon3.png")}}"></div>
                            </li>
                        </ul>
                    </div>
                    <div class="bannerImage col-md-6 col-xs-12 hidden-xs hidden-sm">
                        <img class="img1" src="{{url("template/site/styles/images/imac1.png")}}">


                    </div>
                </div>
            </div><!-- end bannerInner -->
        </div><!-- end Container -->
    </div><!-- end contentContainer -->

    <div class="contentTopContainer">
        <div class="container">
            <div class="contentTopInner row">
                <div class="contentTop">
                    <h3>چه امکاناتی در Ad Clicki در انتظار شماست؟</h3>
                    <div class="contentTopcnt">
                        <div class="cntTop cntTop1 col-lg-4 col-xs-6">
                            <div class="cntTopImg col-sm-4 col-xs-3"><img
                                        src="{{url("template/site/styles/images/cntTop_icon1.png")}}"></div>
                            <div class="cntTopText col-sm-8 col-xs-9">
                                <h4>تبلیغات ارزان بازدهی بالا</h4>
                                <p>با مناسبترین قیمتها تبلیغات خود را به ما بسپارید. بازدهی آن را مقایسه کنید و
                                    آگهی خود را تمدید کنید.</p>
                            </div>
                        </div>
                        <div class="cntTop cntTop2 col-lg-4 col-xs-6">
                            <div class="cntTopImg col-sm-4 col-xs-3"><img
                                        src="{{url("template/site/styles/images/cntTop_icon2.png")}}"></div>
                            <div class="cntTopText col-sm-8 col-xs-9">
                                <h4>کسب درآمد بالا</h4>
                                <p>در Ad Clicki شما این امکان را دارید از روشهای مختلف درآمدزایی کنید و شغل دوم
                                    اینترنتی خود را شروع کنید. هر کلیک و انجام آفر درآمد بالایی را برای شما
                                    خواهد داشت.</p>
                            </div>
                        </div>
                        <div class="cntTop cntTop3 col-lg-4 col-xs-6">
                            <div class="cntTopImg col-sm-4 col-xs-3"><img
                                        src="{{url("template/site/styles/images/cntTop_icon5.png")}}"></div>
                            <div class="cntTopText col-sm-8 col-xs-9">
                                <h4>واکنشگرایی و پنل مدیریت</h4>
                                <p>این وبسایت کاملا واکنشگرا طراحی شده است تا شما بتوانید از هر دستگاهی وارد
                                    حساب خود شوید و به راحتی به ادامه فعالیت خود بپردازید محیط کاربری آسان و
                                    زیبا در اختیار شماست.</p>
                            </div>
                        </div>
                        <div class="cntTop cntTop4 col-lg-4 col-xs-6">
                            <div class="cntTopImg col-sm-4 col-xs-3"><img
                                        src="{{url("template/site/styles/images/cntTop_icon4.png")}}"></div>
                            <div class="cntTopText col-sm-8 col-xs-9">
                                <h4>آمار و اطلاعات دقیق</h4>
                                <p>نمودار ها و گزارش دقیق از کلیک ها و درآمد های شما و زیرمجموعه هایتان همیشه
                                    آماده ارائه به شما میباشد پس بدون هیچ نگرانی کار خود را شروع کنید.</p>
                            </div>
                        </div>
                        <div class="cntTop cntTop5 col-lg-4 col-xs-6">
                            <div class="cntTopImg col-sm-4 col-xs-3"><img
                                        src="{{url("template/site/styles/images/cntTop_icon6.png")}}"></div>
                            <div class="cntTopText col-sm-8 col-xs-9">
                                <h4>زیرمجموعه مستقیم</h4>
                                <p>با خیال راحت میتوانید Ad Clicki را به دوستان خود معرفی کنید و تا 30% از
                                    فعالیت آنها نیز درآمد داشته باشید. اگر نیاز به محدودیت بالاتری دارید حتما
                                    حساب خود را ارتقا دهید.</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div><!-- end contentTopInner -->
        </div><!-- end container-->
    </div><!-- end contentTopContainer -->
    <div class="contentMidContainer">
        <div class="container">
            <div class="contentMidInner row">
                <div class="contentMid">
                    <div class=" cntMid col-lg-12 col-xs-12">
                        <div class="cntMidText col-lg-7 col-xs-7">
                            <h3>روش کار اد کلیکی Ad Clicki به چه صورت خواهد بود؟</h3>
                            <p>در تبلیغات کلیکی Ad Clicki ما آگهی های مختلف را از تبلیغ دهندگان دریافت میکنیم و
                                با 90% درآمد آن به کاربران خود نمایش میدهیم تا کاربران از آگهی های نمایش یافته
                                درآمد کسب نمایند. سود سایت از همین 10% باقی مانده و آگهی های بنری و پاپ آپ خواهد
                                بود پس امیدوارم که توجه به این آگهی ها داشته باشید :) ما این میزان درآمد را برای
                                ارتقا سطح کیفی سایت و تبلیغات و افزایش درآمد کاربران هزینه خواهیم کرد.</p>
                            <p>جهت افزایش درآمد کاربران ما امکانات بیشتری را برای عضویت های ارتقا یافته قرار
                                دادیم تا محدودیت ها را کم کرده باشیم و کاربران بتوانند راحت تر به درآمد زایی
                                بپردازند. همچنین برخلاف سایر سایتها ما اینجا زیرمجموعه اجاره ای رباط نداریم چرا
                                که کسب درآمد از این روش حلال و شرعی نمی باشد. دقت کنید که اینجا یک بنگاه سوددهی
                                نیست و توقع درآمدهای نجومی نداشته باشید. ما بستر را آماده میکنیم همه چیز به تخصص
                                شما بستگی دارد.</p>
                        </div>
                        <div class="cntMidImg col-lg-5 col-xs-5">
                            <img src="{{url("template/site/styles/images/cntMid_image.png")}}">
                        </div>
                    </div>
                </div>
            </div><!-- end contentMidInner-->
        </div><!-- end container-->
    </div><!-- end contentMidContainer-->
    <div class="statisticContainer">
        <div class="container">
            <div class="statisticInner row">
                <div class="statistic member_online col-sm-3 col-xs-6">
                    <div class="statisticImg">
                        <img src="{{url("template/site/styles/images/statistic_icon1.png")}}">
                    </div>
                    <div class="statisticText">
                        <h3>{{rand(10,30)}}</h3>
                        <p>کاربران آنلاین</p>
                    </div>
                </div>
                <div class="statistic total_paid col-sm-3 col-xs-6">
                    <div class="statisticImg">
                        <img src="{{url("template/site/styles/images/statistic_icon2.png")}}">
                    </div>
                    <div class="statisticText">
                        <h3>1,250,000 تومان</h3>
                        <p>کل پرداختی ها</p>
                    </div>
                </div>
                <div class="statistic total_member col-sm-3 col-xs-6">
                    <div class="statisticImg">
                        <img src="{{url("template/site/styles/images/statistic_icon3.png")}}">
                    </div>
                    <div class="statisticText">
                        <h3>{{\App\User::count()+1000}}</h3>

                        <p>تعداد کاربران</p>
                    </div>
                </div>
                <div class="statistic new_member col-sm-3 col-xs-6">
                    <div class="statisticImg">
                        <img src="{{url("template/site/styles/images/statistic_icon4.png")}}">
                    </div>
                    <div class="statisticText">
                        <h3>{{\App\User::where('created_at','>',getToday())->count()}}</h3>
                        <p>کاربران امروز</p>
                    </div>
                </div>
            </div><!-- end statisticInner -->
        </div><!-- end Container -->
    </div><!-- end statisticContainer -->
    <div class="contentBotContainer">
        <div class="container">
            <div class="contentBotInner row">
                <div class="col-lg-12">
                    <div class="cntBotImg col-sm-5 col-xs-5"><img
                                src="{{url("template/site/styles/images/cntBot_image.png")}}"></div>
                    <div class="cntBotText col-sm-7 col-xs-7">
                        <h3>بهترین مکان برای تبلیغات شما</h3>
                        <p>فقط اد کلیکی پشتیبان واقعی آگهی شما خواهد بود ، محصول و یا وب سایت خود را به ما
                            بسپارید سیاست کلی ما بر یک اصل بنا شده : کیفیت در عین ارزانترین قیمت . در زیر چند
                            مورد از مزایای تبلیغات در Ad Clicki آمده است</p>
                        <ul>
                            <li>ثبت یا حذف آنی و اتوماتیک آگهی در هر ساعتی از روز و شب بدون نیازی به تایید یا
                                اطلاع رسانی توسط ما
                            </li>
                            <li>کنترل کامل آگهی از جمله ویرایش ، تعداد مشاهده در روز ، قشر کاربری هدف ، متوقف
                                کردن نمایش
                            </li>
                            <li>آمار و اطلاعات آنلاین و کامل از تعداد مشاهده و کلیک آگهی شما به صورت 24 ساعته در
                                اختیارتان قرار دارد
                            </li>
                            <li>سیستم ناظر ضد تقلب و ضد اسپم کیفیت و کارایی آگهی شما را به حداکثر می رساند</li>
                            <li>متودهای تبلیغاتی روز با انواع آگهی های کلیکی ، سورفی ، بنری ، ورود ، آفر و ...
                            </li>
                            <li>طراحی واکنش گرا و هوشمند مشاهده آگهی شما را در تمامی دستگاه ها و سیستم های عامل
                                ممکن می سازد
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <br/>
    <div class="right-banner"><a href="https://pininja.ir" target="_blank"><img src="{{url('pininja.gif')}}" border="0" class="img-responsive"  ></a>
    </div>
    <div class="left-banner"><a href="http://gamenetmanager.ir" target="_blank"><img src="{{url('gamenetmanager.gif')}}" border="0" class="img-responsive"  ></a>
    </div>

    <div class="clear"></div>




    @include('notification')


@endsection