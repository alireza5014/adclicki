
<li class="has_sub">
    <a href="javascript:void(0);" class="waves-effect bg-warning"><i class="fa fa-money"></i> <span
                class="menu-arrow"></span><span>   کسب درآمد </span> </a>
    <ul class="list-unstyled">
        <li>
            <a href="{{route('user.ads.site_list')}}" class="waves-effect">
                {{--<i  class="fa fa-mouse-pointer"></i> --}}
                <span>کسب درآمد از طریق کلیک </span>
                <span class="label label-danger pull-right">{{getTodayUnClickedLink(auth('user')->user()->id,0)}}</span>

            </a>
        </li>

        <li>
            <a href="{{route('user.ads.search_list',['engine'=>'google'])}}" class="waves-effect">
                {{--<i class="fa fa-google"></i> --}}
                <span>کسب درآمد از سرچ گوگل     </span>
                <span class="label label-danger pull-right">{{getTodayUnClickedLink(auth('user')->user()->id,1)}}</span>

            </a>
        </li>

        <li>
            <a href="{{route('user.ads.search_list',['engine'=>'bing'])}}" class="waves-effect">
                {{--<i class="fa fa-google"></i> --}}
                <span>کسب درآمد از سرچ بینگ     </span>
                <span class="label label-danger pull-right">{{getTodayUnClickedLink(auth('user')->user()->id,2)}}</span>


            </a>
        </li>


        <li>
            <a href="{{route('user.ads.search_list',['engine'=>'yahoo'])}}" class="waves-effect">
                {{--<i class="fa fa-google"></i> --}}
                <span>کسب درآمد از سرچ یاهو     </span>
                <span class="label label-danger pull-right">{{getTodayUnClickedLink(auth('user')->user()->id,3)}}</span>


            </a>
        </li>
        <li>
            <a class="waves-effect">
                {{--<i class="fa fa-google"></i> --}}
                <span>کسب درآمد از سرچ آپارات     </span>
                <span class="label label-danger pull-right">مخصوص کاربران طلایی</span>


            </a>
        </li>

        <li>
            <a class="waves-effect">
                {{--<i class="fa fa-google"></i> --}}
                <span>کسب درآمد از نمایش تبلیغ در وبلاگ    </span>
                <span class="label label-danger pull-right">مخصوص کاربران طلایی</span>


            </a>
        </li>

    </ul>
</li>


<li>
    <a href="{{route('user.referer.list')}}" class="waves-effect"><i class="fa fa-user"></i>
        <span> لیست زیر مجموعه ها </span>
    </a>
</li>


<li class="has_sub">
    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-bank"></i> <span
                class="menu-arrow"></span><span>      برداشت وجه از حساب    </span> </a>
    <ul class="list-unstyled">
        <li>
            <a href="{{route('user.withdrawals.new')}}" class="waves-effect">
                <span> درخواست برداشت وجه </span>
            </a>
        </li>
        <li>
            <a href="{{route('user.withdrawals.list')}}" class="waves-effect"> <span>  لیست درخواست های برداشت </span>
            </a>
        </li>


    </ul>
</li>

