
<li>
    <a href="{{url('user/payments/buy/click')}}" class="waves-effect  "><i
                class="fa fa-shopping-bag"></i> <span>   خرید کلیلک </span>
    </a>
</li>


<li class="has_sub">
    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-chart-bar"></i> <span
                class="menu-arrow"></span><span>    مدیریت تبلیغات من </span> </a>
    <ul class="list-unstyled">
        <li><a href="{{route('user.ads.clicki.new')}}" class="waves-effect">
                <span>     ثبت تبلیغ کلیکی</span> </a></li>
        <li><a href="{{route('user.ads.clicki.list')}}" class="waves-effect">
                <span> لیست تبلیغات کلیکی من </span> </a></li>

        <li><a href="{{route('user.ads.google_search.new')}}" class="waves-effect"> <span>     ثبت تبلیغ جستجو  </span>
            </a></li>
        <li><a href="{{route('user.ads.google_search.list')}}" class="waves-effect"> <span> لیست تبلیغات جستجو من </span>
            </a></li>


    </ul>
</li>

<li>
    <a href="{{url('user/payments/list')}}" class="waves-effect"><i
                class="fa fa-check"></i> <span>    پرداخت های من </span>
    </a>
</li>