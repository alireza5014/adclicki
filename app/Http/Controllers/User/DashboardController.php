<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\Ads;
use App\Model\Job;
use App\Model\JobComment;
use App\Model\JobContact;
use App\Model\JobRate;
use App\Model\JobView;
use App\Model\Payment;
use App\Model\VisitedLink;
use App\Ticket;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {


        $text = "با سلام و عرض ادب خدمت کاربران ادکلیکی";
        $text .= "\n";

        $text .= "امکان تغییر زیر مجموعه توسط کاربر فعال شد. ";
        $text .= "\n";

        $text .= "با خرید زیر مجموعه می توانید درآمد زیادی کسب کنید. ";
        $text .= "\n";

        $text .= "زیر مجموعه ها در آینده نزدیک افزایش قیمت خواهند داشت.";
        $text .= "\n";

        $text .= "برای خرید وارد پنل کاربری خود شوید";
        $text .= "\n";
        $text .= url('');

        $user = User::where('recovery_link', '=', '')->take(1)->select('id', 'email', 'fname', 'lname')->inRandomOrder()->first();;




            try {
                SEND_MESSAGE_WITH_MAIL($user->fname . " " . $user->lname, $user->email, ' کسب درآمد از زیر مجموعه اجاره ای', $text);
                 User::where('id', $user->id)->update(['recovery_link' => str_random(16)]);

            } catch (\Exception $e) {

                file_put_contents('my_errors1.txt', $e->getMessage());
            }




        $data = [];
        $data0 = [

            'موجودی کل' => getTotalBalance(getUserId()),
            'مجموع درآمد ها (کلیک و جستوجو گوگل و بینگ)' => getTotalIncome(getUserId()),

            'مجموع درآمد وب سایت ها' => getTotalWebsite(),
            ' درآمد وب سایت ها(بنری)' => getTotalWebsite("banner"),
            ' درآمد وب سایت ها(پاپ اپ)' => getTotalWebsite("popup"),
            ' درآمد وب سایت ها(پاپ باکس)' => getTotalWebsite("pop_box"),
            'موجودی کلیک ها' => getTotalClick(),
            'مجموع درآمد ها(کلیک)' => getIncome(getUserId(), 0),
            'مجموع درآمد ها(جستجو گوگل)' => getIncome(getUserId(), 1),
            'مجموع درآمد ها(جستجو بینگ)' => getIncome(getUserId(), 2),
            'سهم شما از درآمد زیر مجموعه ها ' => getRefererIncome(getUserId()) + getSubCategoryIncome(getUserId()),
            'تعداد زیر مجموعه ها(خریداری شده و دعوت شده)' => getReferercount(getUserId())+getSubcategoryCount(getUserId()),

            'تعداد تبلیغ های کلیک شده' => VisitedLink::where('visited_id', getUserId())->where('type', 0)->count('price'),
            'تعداد تبلیغ های جستجو شده گوگل' => VisitedLink::where('visited_id', getUserId())->where('type', 1)->count('price'),


            'مجموع  برداشت ها' => number_format(Payment::where('user_id', getUserId())->where('payment_type', 3)->sum('price')),


        ];
        $data1 = [
            'مجموع  پرداخت ها' => number_format(Payment::where('user_id', getUserId())->where('payment_type', 2)->sum('price')),
            'تعداد  آگهی های شما' => Ads::where('user_id', getUserId())->count(),
        ];
        $data2 = [
            'همه تیکت ها' => Ticket::where('user_id', getUserId())->count(),
            'تیکت های پاسخ داده شده' => Ticket::where('status', 1)->where('user_id', getUserId())->count(),
            'تیکت های پاسخ داده نشده' => Ticket::where('status', 0)->where('user_id', getUserId())->count(),
        ];

        switch (getUserActivityType()) {
            case 0:
                $data = array_merge($data0, $data2);
                break;

            case 1:
                $data = array_merge($data1, $data2);

                break;

            case 2:
                $data = array_merge($data0, $data2, $data1);

                break;

        }

        return view('layouts.material.user.home', compact('data'));
    }


    public function user_analyzes_summary($site)
    {
        $lastmonth = Carbon::now()->subDays(30);

        $user_id = getUserId();
        if ($site == 'all') {
            $result['receive_user'] = DB::select("SELECT created_at as y , COUNT(*) as a  FROM `job_views` WHERE created_at > '{$lastmonth}' && `user_id`='{$user_id}'   GROUP by DATE_FORMAT(created_at, '%Y/%m/%d' )");
            $result['total_receive'] = JobView::where('created_at', '>', $lastmonth)->where('user_id', $user_id)->count();

            $result['unique_ip_view'] = DB::select("SELECT created_at as y , COUNT(distinct (ip)) as a  FROM `job_views` WHERE created_at > '{$lastmonth}' && `user_id`='{$user_id}'   GROUP by DATE_FORMAT(created_at, '%Y/%m/%d' )");
            $total_unique = JobView::where('created_at', '>', $lastmonth)->where('user_id', $user_id)->select(DB::raw('count(distinct(ip)) as total_unique'))->first();
            $result['total_unique_ip_view'] = $total_unique['total_unique'];

        } else {


            $result['receive_user'] = DB::select("SELECT created_at as y , COUNT(*) as a  FROM `job_views` WHERE created_at > '{$lastmonth}' && `user_id`='{$user_id}' && `os`='{$site}'   GROUP by DATE_FORMAT(created_at, '%Y/%m/%d' )");
            $result['total_receive'] = JobView::where('created_at', '>', $lastmonth)->where('user_id', $user_id)->where('os', $site)->count();

            $result['unique_ip_view'] = DB::select("SELECT created_at as y , COUNT(distinct (ip)) as a  FROM `job_views` WHERE created_at > '{$lastmonth}' && `user_id`='{$user_id}'  && `os`='{$site}'   GROUP by DATE_FORMAT(created_at, '%Y/%m/%d' )");
            $total_unique = JobView::where('created_at', '>', $lastmonth)->where('user_id', $user_id)->where('os', $site)->select(DB::raw('count(distinct(ip)) as total_unique'))->first();
            $result['total_unique_ip_view'] = $total_unique['total_unique'];

        }


        $result['total'] = JobView::where('user_id', $user_id)->count();


        $result['os'] = JobView::select(DB::raw('ROUND(count(id) *100/' . $result['total'] . ',1) as value'), 'os as label')->groupBy('os')->where('user_id', $user_id)->get();
        $result['browser'] = JobView::select(DB::raw('ROUND(count(id) *100/' . $result['total'] . ',1) as value'), 'browser as  label')->groupBy('browser')->where('user_id', $user_id)->get();
        $result['device'] = JobView::select(DB::raw('ROUND(count(id) *100/' . $result['total'] . ',1) as value'), 'device as  label')->groupBy('device')->where('user_id', $user_id)->get();


        return $result;
    }

}
