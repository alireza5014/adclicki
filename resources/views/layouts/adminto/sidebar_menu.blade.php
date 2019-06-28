<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
     aria-hidden="true" style=" top:30%;display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="mySmallModalLabel"> خروج </h4>
            </div>
            <div class="modal-body">
                <a href="{{url('logout')}}"><i class="fa fa-book"></i>
                    <span>    {{trans('admin_panel.logout')}}</span></a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="user-box " style="padding: 1px 1px 1px 1px !important;">

    <div class="card-box-1">
        <ul class="list-inline">
            <li>
                <a href="{{route('user_profile',['id'=>auth($guard)->user()->id])}}">
                    <img src="{{url(auth($guard)->user()->image_path)}}" alt="user-img" title=""
                         class="img-circle img-thumbnail img-responsive " width="30px">
                </a>
            </li>
            <li>
                <a href="#">{{auth($guard)->user()->fname }} {{auth($guard)->user()->lname}}</a>

            </li>
            <li>{{user_type(auth($guard)->user()->type)}}</li>
        </ul>
        @if(auth($guard)->user()->country!='Iran' && auth($guard)->user()->country!='')
            <p class="error text-center">شما از IP کشور ({{auth($guard)->user()->country}}) استفاده کرده اید و طبق
                قوانین سایت حساب کاربری شما حذف خواهد شد</p>

        @endif
    </div>

    <ul class="list-inline">


        @if($guard=='admin')
            <li>
                <a href="{{route('admin_profile',['id'=>auth($guard)->user()->id])}}">
                    <i class="zmdi zmdi-edit"></i>
                </a>
            </li>

            <a href="{{route('getLogout')}}"> <i class="zmdi zmdi-power btn btn-xs btn-danger"></i> </a>
        @else

            <li>
                <a href="{{route('user.password')}}" title="تغییر گذرواژه">
                    <i class="zmdi zmdi-key btn btn-xs btn-primary"></i>
                </a>
            </li>


            <li>
                <a href="{{route('user_profile',['id'=>auth($guard)->user()->id])}}" title="ویرایش پروفایل">
                    <i class="zmdi zmdi-edit btn btn-xs btn-info"></i>
                </a>
            </li>
            <li><a href="{{route('getUserLogout')}}" title="  خروج از حساب کاربری"> <i
                            class="zmdi zmdi-power btn btn-xs btn-danger"></i> </a></li>
            <li><a href="{{url('')}}" class="  btn-primary btn-xs"><i
                            class="fa fa-internet-explorer  " title="  نمایش سایت"></i></a></li>
        @endif


    </ul>


</div>


<div id="sidebar-menu">

    <div class="clearfix"></div>


    @if($guard=='admin')


        <ul>


            <li>
                <a href="{{url('/admin/home')}}" class="waves-effect"><i class="zmdi zmdi-view-dashboard"></i>
                    <span> داشبورد </span>
                </a>
            </li>

            <li>


                <a href="{{route('admin.withdrawals.list')}}" class="waves-effect"><i
                            class="zmdi zmdi-view-dashboard"></i>

                    <span class="label label-danger pull-right">{!! getUnPayedWithdraw() !!}</span>
                    <span> درخواست واریز ها </span>
                </a>


            </li>


            <li>
                <a href="{{route('admin.ads.clicki.list')}}" class="waves-effect">
                    <i class="zmdi zmdi-view-dashboard"></i>
                    <span class="label label-danger pull-right">{!! getUnConfirmClickiAds() !!}</span>

                    <span> لیست تبلیغات کلیکی   </span> </a></li>
            </li>

            <li>
                <a href="{{route('admin.ads.google_search.list')}}" class="waves-effect">
                    <i class="zmdi zmdi-view-dashboard"></i>
                    <span class="label label-danger pull-right">{!! getUnConfirmGoogleSearchAds() !!}</span>

                    <span> لیست تبلیغات  جستجو گوگل   </span> </a></li>
            </li>


            <li>
                <a href="{{route('admin.payments.list')}}" class="waves-effect">
                    <i class="zmdi zmdi-view-dashboard"></i>
                    <span class="label label-danger pull-right">{!! getUserPayment() !!}</span>

                    <span> لیست   پرداخت ها   </span> </a></li>
            </li>


            <li class="has_sub">
                <a href="javascript:void(0);" class="waves-effect"><i class="zfa fa-location-arrow"></i> <span
                            class="menu-arrow"></span><span>  آنالیز سایت </span> </a>
                <ul class="list-unstyled">
                    <li><a href="{{route('analyzes')}}" class="waves-effect"> <span> نمودار ها</span> </a></li>
                    <li><a href="{{route('analyzes_keywords')}}" class="waves-effect"> <span>  کلمات کلیدی </span> </a>
                    </li>
                    <li><a href="{{route('analyzes_links')}}" class="waves-effect"> <span> لینک ها</span> </a></li>


                </ul>
            </li>

            <li class="has_sub">
                <a href="javascript:void(0);" class="waves-effect"><i class="zfa fa-location-arrow"></i> <span
                            class="menu-arrow"></span><span>    کاربران </span> </a>
                <ul class="list-unstyled">
                    <li><a href="{{route('create_user')}}" class="waves-effect"> <span>   کاربر جدید</span> </a></li>
                    <li><a href="{{route('users_message_list')}}" class="waves-effect">
                            <span>      لیست پیامهای کاربران</span> </a></li>
                    <li><a href="{{route('users_list')}}" class="waves-effect"> <span> لیست همه کاربران</span> </a></li>
                    </li>


                </ul>
            </li>


            <li>
                <a href="{{url('admin/tickets/all')}}" class="waves-effect">
                    <i class="fa fa-instagram"></i>
                    <span class="label label-danger pull-right">{!! getUnAnsweredTicket() !!}</span>

                    <span> تیکت ها </span>
                </a>
            </li>


            <li class="has_sub">
                <a href="javascript:void(0);" class="waves-effect"><i class="zfa fa-location-arrow"></i> <span
                            class="menu-arrow"></span><span>    تنظیمات </span> </a>
                <ul class="list-unstyled">
                    <li><a href="{{url('admin/setting')}}" class="waves-effect"> <span>     تنظیمات عمومی   </span> </a>
                    </li>
                    <li><a href="{{route('web_hook.edit')}}" class="waves-effect"> <span>   تنظیم وب هوک    </span> </a>
                    </li>
                </ul>
            </li>


            <li>
                <a href="{{route('site_map')}}" class="waves-effect"><i class="zmdi zmdi-view-dashboard"></i>
                    <span>    ساخت نقشه سایت </span>
                </a>
            </li>


        </ul>


    @elseif($guard=='user')
        <ul>


            <li>
                <a href="{{url('user/home')}}" class="waves-effect"><i
                            class="zmdi zmdi-view-dashboard"></i> <span> میز کار </span>
                </a>
            </li>


            @if(getActivityType()==0)
                @include('layouts.adminto.menu0')
            @elseif(getActivityType()==1)

                @include('layouts.adminto.menu1')


            @else
                @include('layouts.adminto.menu1')

                @include('layouts.adminto.menu0')

            @endif




            <li>
                <a href="{{url('user/ticket-list')}}" class="waves-effect"><i
                            class="fa fa-ticket"></i> <span> تیکت پشتیبانی </span>
                </a>
            </li>


            <li class="has_sub">
                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-user"></i> <span
                            class="menu-arrow"></span><span>      مدیریت پروفایل  </span> </a>
                <ul class="list-unstyled">
                    <li>
                        <a href="{{route('user_profile',['id'=>auth($guard)->user()->id])}}" class="waves-effect">
                            <span> ویرایش اطلاعات کاربری </span>
                        </a>
                    </li>


                    <li>
                        <a href="{{route('user.edit.bank_info')}}" class="waves-effect">  <span>     ویرایش اطلاعات بانکی </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('user.password')}}" class="waves-effect">
                            <span>  تغییر رمز عبور </span>
                        </a>
                    </li>


                </ul>
            </li>

            <li>
                <a href="{{url('user/notification')}}" class="waves-effect"><i
                            class="fa fa-telegram"></i> <span>   اطلاع رسانی (تلگرام) </span>
                    <span class="label label-danger pull-right">جدید</span>

                </a>
            </li>

            <li>
                <a href="{{url('user/message')}}" class="waves-effect"><i
                            class="fa fa-newspaper"></i> <span>   پیامها </span>
                    <span class="label label-danger pull-right">1</span>

                </a>
            </li>
            <li>
                <a href="{{url('user/learning')}}" class="waves-effect"><i
                            class="fa fa-book"></i> <span>   آموزش </span>
                </a>
            </li>
        </ul>
    @endif

</div>


