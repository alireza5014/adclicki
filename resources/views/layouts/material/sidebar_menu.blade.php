<div class="scrollbar-inner card">
    <div class="user">
        <div class="user__info" data-toggle="dropdown">
            <img class="user__img" src="{{$path}}/demo/img/profile-pics/8.jpg" alt="">
            <div>
                <div class="user__name">{{auth('user')->user()->fname." ".auth('user')->user()->lname}}    </div>
                <div class="user__email">{{auth('user')->user()->email}}</div>
            </div>
        </div>

        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{route('user_profile',['id'=>auth($guard)->user()->id])}}">مشاهده
                پروفایل</a>
            <a class="dropdown-item" href="{{route('user.password')}}"> تغییر گذرواژه</a>
            <a class="dropdown-item" href="{{route('getUserLogout')}}"> خروج</a>
        </div>
    </div>

    <ul class="navigation">
        <li class="navigation__active"><a href="{{url('user/home')}}"><i class="zmdi zmdi-home"></i> میز کار</a></li>

        <li class="navigation__sub @@variantsactive">
            <a><i class="zmdi zmdi-view-week"></i> کسب درآمد </a>

            <ul>
                <li class="@@sidebaractive"><a href="{{route('user.ads.site_list')}}"> کسب درآمد از طریق کلیک
                        <span style="float: left">    {{getTodayUnClickedLink(getUserId(),0)}}</span>
                    </a></li>

                <li class="@@boxedactive"><a href="{{route('user.ads.search_list',['engine'=>'google'])}}"> کسب درآمد از
                        سرچ گوگل
                        <span style="float: left">    {{getTodayUnClickedLink(getUserId(),1)}}</span>
                    </a></li>
                <li class="@@hiddensidebarboxedactive"><a href="{{route('user.ads.search_list',['engine'=>'bing'])}}">
                        کسب درآمد از سرچ بینگ
                        <span style="float: left">    {{getTodayUnClickedLink(getUserId(),2)}}</span>
                    </a></li>
                <li class="@@hiddensidebarboxedactive"><a href="{{route('user.ads.search_list',['engine'=>'bing'])}}">
                        کسب درآمد از سرچ یاهو
                        <span style="float: left">    {{getTodayUnClickedLink(getUserId(),3)}}</span>
                    </a></li>
                <li class="@@hiddensidebarboxedactive"><a>
                        کسب درآمد از سرچ آپارات
                        <span style="float: left">     </span>

                    </a></li>
            </ul>
        </li>

        <li>
            <a href="{{url('user/payments/list')}}" class="waves-effect">
                <i class="zmdi zmdi-view-week"></i>
                <span>    پرداخت های من </span>
            </a>
        </li>


        <li>
            <a href="{{route('user.referer.list')}}" class="waves-effect">
                <i class="zmdi zmdi-view-week"></i>

                <span> لیست زیر مجموعه ها </span>
            </a>
        </li>


        <li class="navigation__sub @@variantsactive">
            <a><i class="zmdi zmdi-view-week"></i> برداشت وجه از حساب </a>

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
            <a href="{{url('user/ticket-list')}}" class="waves-effect">
                <i class="zmdi zmdi-view-week"></i>

                <span> تیکت پشتیبانی </span>
            </a>
        </li>


        <li class="navigation__sub @@variantsactive">
            <a><i class="zmdi zmdi-view-week"></i> مدیریت پروفایل </a>

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
                <i class="zmdi zmdi-view-week"></i>

                <span>   اطلاع رسانی (تلگرام) </span>
            </a>
        </li>

        <li>
            <a href="{{url('user/message')}}" class="waves-effect">
                <i class="zmdi zmdi-view-week"></i>

                <span>   پیامها </span>
            </a>
        </li>

        <li>
            <a href="{{url('user/learning')}}" class="waves-effect">
                <i class="zmdi zmdi-view-week"></i>

                <span>   آموزش </span>
            </a>
        </li>


    </ul>
</div>
