<div class="scrollbar-inner card">
    <div class="user">
        <div class="user__info" data-toggle="dropdown">
            <img class="user__img" src="{{$path}}/demo/img/profile-pics/8.jpg" alt="">
            <div>
                <div class="user__name">{{auth('user')->user()->fname." ".auth('user')->user()->lname}}    </div>
                <div class="user__email">{{auth('user')->user()->email}}</div>
            </div>


        </div>
        <a class="btn btn-sm btn-primary"
           href="https://t.me/adclicki_bot?start=code_{{base64_encode(getUserId())}}">برای عضویت
            در ربات تلکرام اینجا کلیک کنید </a>

        <code dir="ltr">@adclicki_bot</code>
        <p> کد فعالسازی شما : <code dir="ltr">{{base64_encode(getUserId())}}</code></p>

        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{route('user_profile',['id'=>auth($guard)->user()->id])}}">مشاهده
                پروفایل</a>
            <a class="dropdown-item" href="{{route('user.password')}}"> تغییر گذرواژه</a>
            <a class="dropdown-item" href="{{route('getUserLogout')}}"> خروج</a>
        </div>
    </div>

    <ul class="navigation">
        <li class="navigation__active"><a href="{{url('user/home')}}"><i class="zmdi zmdi-home"></i> میز کار</a></li>


        <li>
            <a href="{{url('user/payments/buy/click')}}" class="waves-effect  ">
                <i class="zmdi zmdi-shopping-basket"></i> <span>   خرید کلیلک </span>
            </a>
        </li>


        <li class="navigation__sub @@variantsactive">
            <a><i class="zmdi zmdi-view-week"></i>
                <span style="float: left" class="badge badge-pill badge-default ">  <i class="zmdi zmdi-arrow-out"></i>  </span>

                تبلیغ دهندگان </a>

            <ul>
                {{--                <li class="@@sidebaractive"><a href="{{route('user.ads.clicki.new')}}"> ثبت تبلیغ کلیکی </a></li>--}}
                <li class="@@sidebaractive"><a href="{{route('user.ads.clicki.list')}}"> تبلیغات کلیکی من </a></li>
                {{--<li class="@@sidebaractive"><a href="{{route('user.ads.google_search.new')}}">ثبت تبلیغ جستجو </a></li>--}}
                <li class="@@sidebaractive"><a href="{{route('user.ads.google_search.list')}}"> تبلیغات جستوجوی من </a>
                </li>


            </ul>
        </li>

        <li class="navigation__sub @@variantsactive">
            <a><i class="zmdi zmdi-adb"></i>
                <span style="float: left" class="badge badge-pill badge-default ">  <i class="zmdi zmdi-arrow-out"></i>  </span>

                تبلیغ گیرندگان
            </a>

            <ul>

                <li class="@@sidebaractive"><a href="{{route('user.website.list')}}">
                        <span>     تبلیغات بنری من </span>
                        <span style="float: left" class="badge badge-pill badge-danger ">جدید</span>
                    </a>
                </li>


            </ul>
        </li>





        <li class="navigation__sub @@variantsactive">
            <a><i class="zmdi zmdi-money-box"></i>
                <span style="float: left" class="badge badge-pill badge-default ">  <i class="zmdi zmdi-arrow-out"></i>  </span>

                کسب درآمد


            </a>

            <ul>
                <li class="@@sidebaractive"><a href="{{route('user.ads.site_list')}}"> کسب درآمد از طریق کلیک
                        <span class="badge badge-pill badge-danger"
                              style="float: left">    {{getTodayUnClickedLink(getUserId(),0)}}</span>
                    </a></li>

                <li class="@@boxedactive"><a href="{{route('user.ads.search_list',['engine'=>'google'])}}"> کسب درآمد از
                        سرچ گوگل
                        <span class="badge badge-pill badge-danger"
                              style="float: left">    {{getTodayUnClickedLink(getUserId(),1)}}</span>
                    </a></li>
                <li class="@@hiddensidebarboxedactive"><a href="{{route('user.ads.search_list',['engine'=>'bing'])}}">
                        کسب درآمد از سرچ بینگ
                        <span class="badge badge-pill badge-danger"
                              style="float: left">    {{getTodayUnClickedLink(getUserId(),2)}}</span>
                    </a></li>
                <li class="@@hiddensidebarboxedactive"><a href="{{route('user.ads.search_list',['engine'=>'yahoo'])}}">
                        کسب درآمد از سرچ یاهو
                        <span class="badge badge-pill badge-danger"
                              style="float: left">    {{getTodayUnClickedLink(getUserId(),3)}}</span>
                    </a></li>
                <li class="@@hiddensidebarboxedactive"><a href="{{route('user.ads.search_list',['engine'=>'aparat'])}}">
                        کسب درآمد از سرچ آپارات
                        <span class="badge badge-pill badge-danger"
                              style="float: left">{{getTodayUnClickedLink(getUserId(),4)}}     </span>

                    </a></li>


                {{--<li class="@@hiddensidebarboxedactive"><a href="#">--}}
                {{--کسب درآمد از فالور اینستاگرام--}}
                {{--<span class="badge badge-pill badge-danger"--}}
                {{--style="float: left">بزودی    </span>--}}

                {{--</a></li>--}}


                <li class="@@hiddensidebarboxedactive"><a href="{{route('user.salary')}}">
                        آمار کسب درآمد
                        <span class="badge badge-pill badge-danger"
                              style="float: left">NEW    </span>

                    </a></li>
            </ul>
        </li>

        <li class="navigation__sub @@variantsactive">
            <a><i class="zmdi zmdi-view-week"></i>
                <span style="float: left" class="badge badge-pill badge-default ">  <i class="zmdi zmdi-arrow-out"></i>  </span>
                زیر مجموعه </a>

            <ul>
                <li>
                    <a href="{{route('user.subcategory.list')}}" class="waves-effect">
                        <i class="zmdi zmdi-view-week"></i>

                        <span>     زیر مجموعه اجاره ایی</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('user.referer.list')}}" class="waves-effect">
                        <i class="zmdi zmdi-view-week"></i>

                        <span>   زیر مجموعه های دعوت شده </span>
                    </a>
                </li>

            </ul>
        </li>


        <li class="navigation__sub @@variantsactive">
            <a><i class="zmdi zmdi-star-half"></i>
                <span style="float: left" class="badge badge-pill badge-default ">  <i class="zmdi zmdi-arrow-out"></i>  </span>

                برداشت وجه از حساب
            </a>

            <ul>
                <li class="@@sidebaractive"><a href="{{route('user.withdrawals.new')}}">
                        درخواست برداشت وجه

                    </a>
                </li>

                <li class="@@sidebaractive"><a href="{{route('user.withdrawals.list')}}">
                        لیست درخواست های برداشت

                    </a>
                </li>

            </ul>
        </li>

        <li>
            <a href="{{url('user/payments/list')}}" class="waves-effect">
                <i class="zmdi zmdi-paypal"></i><span>    پرداخت های من </span>
            </a>
        </li>
        <li>
            <a href="{{url('user/ticket-list')}}" class="waves-effect">
                <i class="zmdi zmdi-ticket-star"></i>

                <span> تیکت پشتیبانی </span>
            </a>
        </li>


        <li class="navigation__sub @@variantsactive">
            <a><i class="zmdi zmdi-account"></i>
                <span style="float: left" class="badge badge-pill badge-default ">  <i class="zmdi zmdi-arrow-out"></i>  </span>

                مدیریت پروفایل
            </a>

            <ul>


                <li class="@@sidebaractive">
                    <a href="{{route('user_profile',['id'=>auth($guard)->user()->id])}}">
                        <span> ویرایش اطلاعات کاربری </span>
                    </a>
                </li>


                <li class="@@sidebaractive">
                    <a href="{{route('user.edit.bank_info')}}"> <span>     ویرایش اطلاعات بانکی </span>
                    </a>
                </li>

                <li class="@@sidebaractive">
                    <a href="{{route('user.password')}}">
                        <span>  تغییر رمز عبور </span>
                    </a>
                </li>

            </ul>
        </li>


        <li>
            <a href="{{url('user/notification')}}" class="waves-effect">
                <i class="zmdi zmdi-mail-send"></i>

                <span>   اطلاع رسانی (تلگرام) </span>
            </a>
        </li>

        <li>
            <a href="{{url('user/message')}}" class="waves-effect">
                <i class="zmdi zmdi-view-week"></i>

                <span>   پیامها </span>
                <span style="float: left" class="badge badge-pill badge-danger "> 1</span>
            </a>
        </li>

        <li>
            <a href="{{url('user/learning')}}" class="waves-effect">
                <i class="zmdi zmdi-leak"></i>

                <span>   آموزش </span>
            </a>
        </li>


    </ul>
</div>
