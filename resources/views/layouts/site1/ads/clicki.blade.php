@extends('layouts.site1.layout')
@section('head')
    @parent

    <title>تبلیغات کلیکی |  سایت اد کلیکی</title>


    <meta name="description" content="تبلیغات کلیکی">
    <meta name="keywords" content="  تبلیغات کلیکی , افزایش رتبه الکسا  ">
    
    <meta name="author" content="علیرضا حیدری">
 

    <meta property="og:image" content="https://adclicki.ir/adclicki.jpg"
          data-react-helmet="true">
    <meta property="og:image:width" content="1161" data-react-helmet="true">
    <meta property="og:image:height" content="1022" data-react-helmet="true">
    <meta property="twitter:card" content="summary_large_image" data-react-helmet="true">
    <meta property="twitter:site" content="@padclicki_ir" data-react-helmet="true">

    <meta property="twitter:creator" content="@padclicki_ir" data-react-helmet="true">
    <meta property="twitter:description"
          content="تبلیغات کلیکی"
          data-react-helmet="true">
    <meta property="twitter:title" content=" تبلیغات کلیکی "
          data-react-helmet="true">
    <meta property="og:description"
          content="تبلیغات کلیکی"
          data-react-helmet="true">
    <meta property="og:title" content=" تبلیغات کلیکی "
          data-react-helmet="true">
    <meta name="description"
          content="تبلیغات کلیکی"
          data-react-helmet="true">

@stop

@section('content')
    <main>

        <section class="popup page">
            <div class="container clearfix">
                <div class="popup-box clearfix">
                    <div class="span-sm-12 span-xs-12 span-md-5 box-img">
                        <img src="{{url('template/site1')}}/template/site/images/alexa.png" alt="کاهش رتبه الکسا" title="بهبود رتبه الکسا">
                    </div>
                    <div class="span-sm-12 span-xs-12 span-md-7">
                        <div class="popup-text">
                            <div class="section-title">
                                <span class="icon-presentation fs1" aria-hidden="true" ></span>
                                <div class="section-title-box">
                                    <h2>تبلیغات کلیکی</h2>
                                    <h5>روشی مطمئن برای کاهش رتبه الکسا و کسب درآمد از ترافیک سایت</h5>
                                </div>
                            </div>
                            <p>در تبلیغات کلیکی ما آگهی های مختلف را از تبلیغ دهندگان دریافت میکنیم و آن را به کاربران خود نمایش میدهیم تا کاربران از آگهی های نمایش یافته درآمد کسب نمایند. پس امیدوارم که توجه به این آگهی ها داشته باشید . جهت افزایش درآمد کاربران ما امکانات بیشتری را برای عضویت های ارتقا یافته قرار دادیم تا محدودیت ها را کم کرده باشیم و کاربران بتوانند راحت تر به درآمد زایی بپردازند. همچنین برخلاف سایر سایتها ما اینجا زیرمجموعه اجاره ای رباط نداریم چرا که کسب درآمد از این روش حلال و شرعی نمی باشد. دقت کنید که اینجا یک بنگاه سوددهی نیست و توقع درآمدهای نجومی نداشته باشید. ما بستر را آماده میکنیم همه چیز به تخصص شما بستگی دارد</p>
                            <a href="{{url('login')}}" class="button">ورود و سفارش <i class="fa fa-chevron-left"></i></a>
                            <a href="{{url('ads/search')}}" class="button">توضیحات بیشتر ... <i class="fa fa-chevron-left"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>





    </main>
@endsection