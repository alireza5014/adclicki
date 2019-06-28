<?php

namespace App\Http\Controllers\User;

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
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {




        $data = [

            'موجودی کل'=>getTotalBalance(getUserId()),
            'مجموع درآمد ها (کلیک و جستوجو گوگل و بینگ)'=>getTotalIncome(getUserId()),

            'مجموع درآمد وب سایت ها'=>getTotalWebsite(),
            ' درآمد وب سایت ها(بنری)'=>getTotalWebsite("banner"),
            ' درآمد وب سایت ها(پاپ اپ)'=>getTotalWebsite("popup"),
            ' درآمد وب سایت ها(پاپ باکس)'=>getTotalWebsite("pop_box"),
            'موجودی کلیک ها'=>getTotalClick(),
             'مجموع درآمد ها(کلیک)'=>getIncome(getUserId(),0),
            'مجموع درآمد ها(جستجو گوگل)'=>getIncome(getUserId(),1),
            'مجموع درآمد ها(جستجو بینگ)'=>getIncome(getUserId(),2),
            'سهم شما از درآمد زیر مجموعه ها'=>getRefererIncome(getUserId()),
            'تعداد زیر مجموعه ها'=>getReferercount(getUserId()),

            'تعداد تبلیغ های کلیک شده' => VisitedLink::where('visited_id', getUserId())->where('type',0)->count('price'),
            'تعداد تبلیغ های جستجو شده گوگل' => VisitedLink::where('visited_id', getUserId())->where('type',1)->count('price'),


            'مجموع  پرداخت ها' => number_format(Payment::where('user_id', getUserId())->where('payment_type',2)->sum('price')),
            'مجموع  برداشت ها' => number_format(Payment::where('user_id', getUserId())->where('payment_type',3)->sum('price')),


            'تعداد  آگهی های شما' => Ads::where('user_id', getUserId())->count(),

            'همه تیکت ها' => Ticket::where('user_id', getUserId())->count(),
            'تیکت های پاسخ داده شده' => Ticket::where('status', 1)->where('user_id', getUserId())->count(),
            'تیکت های پاسخ داده نشده' => Ticket::where('status', 0)->where('user_id', getUserId())->count(),

        ];


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
