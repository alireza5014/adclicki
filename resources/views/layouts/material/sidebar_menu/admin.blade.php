<div class="scrollbar-inner card">
    <div class="user">
        <div class="user__info" data-toggle="dropdown">
            <img class="user__img" src="{{$path}}/demo/img/profile-pics/8.jpg" alt="">
            <div>
                <div class="user__name">{{auth($guard)->user()->fname." ".auth($guard)->user()->lname}}    </div>
                <div class="user__email">{{auth($guard)->user()->email}}</div>
            </div>
        </div>

        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{route('admin_profile',['id'=>auth($guard)->user()->id])}}">مشاهده
                پروفایل</a>

            <a class="dropdown-item" href="{{route('getLogout')}}"> خروج</a>
        </div>
    </div>

    <ul class="navigation">
        <li class="navigation__active"><a href="{{url('admin/home')}}"><i class="zmdi zmdi-home"></i> میز کار</a></li>






        <li class="navigation__active"><a href="{{route('admin.withdrawals.list')}}"><i class="zmdi zmdi-home"></i>
                <span class="badge badge-pill badge-danger" style="float: left">   {!! getUnPayedWithdraw() !!}</span>

                درخواست واریز ها

            </a></li>


        <li class="navigation__active"><a href="{{route('admin.ads.clicki.list')}}"><i class="zmdi zmdi-home"></i>
                <span  class="badge badge-pill badge-danger" style="float: left">   {!! getUnConfirmClickiAds() !!}</span>

                لیست تبلیغات کلیکی

            </a></li>


        <li class="navigation__active"><a href="{{route('admin.ads.google_search.list')}}"><i class="zmdi zmdi-home"></i>
                <span class="badge badge-pill badge-danger" style="float: left">   {!! getUnConfirmGoogleSearchAds() !!}</span>

                لیست تبلیغات  جستجو گوگل

            </a></li>


        <li class="navigation__active"><a href="{{route('admin.website.list')}}"><i class="zmdi zmdi-home"></i>
                <span class="badge badge-pill badge-danger" style="float: left">  0</span>

                لیست تبلیغات  بنری - پاپ آپ - پاپ باکس

            </a></li>




        <li class="navigation__active"><a href="{{route('admin.payments.list')}}"><i class="zmdi zmdi-home"></i>
                <span class="badge badge-pill badge-danger"  style="float: left">   {!! getUserPayment() !!}</span>

                لیست   پرداخت ها

            </a></li>



        <li class="navigation__sub @@variantsactive">
            <a><i class="zmdi zmdi-view-week"></i> آنالیز سایت </a>

            <ul>
                <li class="@@sidebaractive"><a href="{{route('analyzes')}}">
                        نمودار ها

                    </a>
                </li>

                <li class="@@sidebaractive"><a href="{{route('analyzes_keywords')}}">
                        کلمات کلید

                    </a>
                </li>


                <li class="@@sidebaractive"><a href="{{route('analyzes_links')}}">
                        لینک ها

                    </a>
                </li>

            </ul>
        </li>



        <li class="navigation__sub @@variantsactive">
            <a><i class="zmdi zmdi-view-week"></i>   کاربران </a>

            <ul>
                <li class="@@sidebaractive"><a href="{{route('create_user')}}">
                        کاربر جدید

                    </a>
                </li>

                <li class="@@sidebaractive"><a href="{{route('users_message_list')}}">
                        لیست پیامهای کاربران

                    </a>
                </li>


                <li class="@@sidebaractive"><a href="{{route('users_list')}}">
                        لیست همه کاربران

                    </a>
                </li>

            </ul>
        </li>





        <li class="navigation__active"><a href="{{url('admin/tickets/all')}}"><i class="zmdi zmdi-home"></i>
                <span class="badge badge-pill badge-danger" style="float: left">   {!! getUnAnsweredTicket() !!}</span>

                    تیکت ها

            </a></li>


        <li class="navigation__sub @@variantsactive">
            <a><i class="zmdi zmdi-view-week"></i>   تنظیمات </a>

            <ul>
                <li class="@@sidebaractive"><a href="{{url('admin/setting')}}">
                        تنظیمات عمومی

                    </a>
                </li>

                <li class="@@sidebaractive"><a href="{{route('web_hook.edit')}}">
                        تنظیم وب هوک

                    </a>
                </li>




            </ul>
        </li>







        </ul>




</div>
