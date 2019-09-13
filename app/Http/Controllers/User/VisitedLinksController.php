<?php

namespace App\Http\Controllers\User;

use App\Model\ViewRequest;
use App\Model\VisitedLink;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class VisitedLinksController extends Controller
{
    public function visit($view_request_id)
    {
//return Carbon::now()->format('Y-m-d');


        $view_request = ViewRequest::where('id', $view_request_id)
            ->whereHas('ad', function ($q) {
                $q->where('status', 1);
            })
            ->with('ad')
            ->first();

        if ($view_request) {
            $visit_count = VisitedLink::where('view_request_id', $view_request_id) ->count();

             if($visit_count<$view_request->count){
                 $count = VisitedLink::where('view_request_id', $view_request_id)
                     ->where('visited_id', getUserId())
                     ->where(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"), Carbon::now()->format('Y-m-d'))
                     ->first();

                 if (isset($count)) {

                     if ($count->price > 0) {
                         $visit = true;
                     } else {
                         $visit = false;

                     }


                 } else {

                     $visit = false;
                     $res = VisitedLink::create([
                             'visited_id' => getUserId(),
                             'view_request_id' => $view_request_id,
                             'ads_id' => $view_request->ads_id,
                             'price' => 0,
                             'referer_price' => 0,
                             'ip' => getIP(),
                             'os' => getOS(),
                             'browser' => getBrowser(),

                         ]
                     );


                 }

                 $ppc = getSetting('ppc')['ppc'];
                 return view('user.visited_link.visit', compact('view_request', 'visit', 'ppc'));


             }
             else{
                 return redirect(route('user.ads.site_list'))->with('error', "کلیک های این آگهی    تمام شده است");

             }

        } else {
            return redirect(route('user.ads.site_list'))->with('error', "این آگهی وجود ندارد");

        }


    }

    public function visit_verify($view_request_id)
    {

        $ads_info = ViewRequest::where('id', $view_request_id)->where('status', 1)->whereHas('ad')->first();

        $setting = getSetting();
        $array = [
            'price' => 0,
            'referer_price' => 0,

        ];
        if ($ads_info) {
            $array = [
                'price' => $setting['ppc'],
                'referer_price' => $setting['ppc'] * $setting['referer_percent'] / 100,

            ];
        }
        $visit_verify = VisitedLink::where('view_request_id', $view_request_id)
            ->where('visited_id', getUserId())
            ->where('price', 0)
            ->where('created_at', '>', getToday())
            ->where('created_at', '<', Carbon::now()->subSecond(30))
            ->update(
                $array
            );

        return view('user.visited_link.verify_visit', compact('ads_info', 'visit_verify'));

    }


    public function view_visited_link(Request $request)
    {
        $ads = VisitedLink::where('visited_id', getUserIdAfterChecking())->orderBy('id', 'DESC')
            ->with(['ad' => function ($q) {
                return $q->select('id', 'ads_id', 'title');
            }])
            ->paginate(20);

        if ($request->ajax()) {
            try {
                return view('layouts.material.user.ads.clicki.table', compact('ads'))->render();
            } catch (\Throwable $e) {
            }
        }
        return view('layouts.material.user.ads.clicki.list', compact('ads'));

    }

}
