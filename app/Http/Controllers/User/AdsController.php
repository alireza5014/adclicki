<?php

namespace App\Http\Controllers\User;

use App\classes\UpLoad;
use App\Http\Requests\AdsRequest;
use App\Http\Requests\GoogleSearchRequest;
use App\Model\Ads;
use App\Model\GoogleSearch;
use App\Model\ViewRequest;
use App\Model\VisitedLink;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdsController extends Controller
{


    public function clicki_edit($id)
    {

        $ads = Ads::where('user_id', getUserId())->where('id', $id)->first();

        return view('user.ads.clicki.edit', compact('ads'));
    }

    public function google_search_edit($id)
    {

        $ads = Ads::where('user_id', getUserId())
            ->with(['google_search' => function ($q) {
                return $q->select('id', 'ads_id', 'keyword', 'page_number');
            }])
            ->where('id', $id)->first();

        return view('user.ads.google_search.edit', compact('ads'));
    }


    public function google_search_modify(GoogleSearchRequest $request)
    {

        $text = getUserId() . "\n" . $request->title . "\n" . "یک آگهی جستجو گوگل ویرایش کرد";
        sendMessageToBot($text, ['618723858','288923947']);

        ($request->link == $request->old_link) ? $status = [] : $status = $status = ['status' => -1];


        Ads::where('user_id', getUserId())->where('id', $request->id)->update(
            array_merge([
                'user_id' => getUserId(),
                'title' => $request->title,
                'link' => $request->link,
                'daily_click' => convert_to_digit($request->daily_click, 'en'),

                'type' => $request->engine_type,

                'image_path' => '',

            ], $status)
        );

        GoogleSearch::where('ads_id', $request->id)->update(
            [
                'keyword' => $request->keyword,
                'page_number' => $request->page_number,
            ]
        );

        return redirect(route('user.ads.google_search.list'))->with('success', 'آگهی شما با موفقیت ویرایش شد');
    }

    public function clicki_modify(AdsRequest $request)
    {

        $text = getUserId() . "\n" . $request->title . "\n" . "یک آگهی کلیکی ویرایش کرد";
        sendMessageToBot($text, ['618723858','288923947']);
        ($request->link == $request->old_link) ? $status = [] : $status = $status = ['status' => -1];

        $store_path = '/images/' . getUserId() . '/ads/';

        $image = UpLoad::create('image')
            ->request($request)
            ->target('main_image')
            ->store_path($store_path)
            ->watermark_path('watermark_logo.png')
            ->resizePercentage(80)
            ->resize_percent(75)
            ->makeUpload();

        Ads::where('user_id', getUserId())->where('id', $request->id)->update(
            array_merge([
                'user_id' => getUserId(),
                'title' => $request->title,
                'link' => $request->link,
                'daily_click' => convert_to_digit($request->daily_click, 'en'),

                'image_path' => $image['image_path'][0],

            ], $status)
        );

        return redirect(route('user.ads.clicki.list'))->with('success', 'آگهی شما با موفقیت ویرایش شد');
    }

    public function clicki_new()
    {

        return view('layouts.material.user.ads.clicki.new');
    }

    public function clicki_list(Request $request)
    {

         $ads = Ads::where('user_id', getUserId())->orderBy('id', 'DESC')
            ->with(['view_request' => function ($q) {
                return $q->select('id', 'ads_id', 'count', 'status');
            }])
            ->withCount('visited_links')
            ->withCount('visited_websites')
            ->where('type', 0)
            ->paginate(20);

        if ($request->ajax()) {
            try {
                return view('layouts.material.user.ads.clicki.table', compact('ads'))->render();
            } catch (\Throwable $e) {
            }
        }
        return view('layouts.material.user.ads.clicki.list', compact('ads'));

    }


    public function google_search_new()
    {
        return view('layouts.material.user.ads.google_search.new');

    }

    public function google_search_list(Request $request)
    {
        $ads = Ads::where('user_id', getUserId())->orderBy('id', 'DESC')
            ->with(['view_request' => function ($q) {
                return $q->select('id', 'ads_id', 'count', 'status');
            }])
            ->with(['google_search' => function ($q) {
                return $q->select('id', 'ads_id', 'keyword', 'page_number');
            }])
            ->whereIn('type', [1, 2, 3, 4])
            ->withCount('visited_links')


            ->paginate(20);

        if ($request->ajax()) {
            try {
                return view('layouts.material.user.ads.google_search.table', compact('ads'))->render();
            } catch (\Throwable $e) {
            }
        }
        return view('layouts.material.user.ads.google_search.list', compact('ads'));

    }


    public function site_clicki_list()
    {

        $visited_link = VisitedLink::where('visited_id', getUserId())
            ->where('created_at', '>', getToday())
            ->where('price', '>', 0)
            ->pluck('view_request_id');


        $ads = Ads::withCount(['visited_links_today' => function ($q) {
            $q->where('created_at', '>', getToday());
        }])
            ->withCount(['visited_links' => function ($q) {
               return $q;
            }])
            ->withCount(['visited_websites' => function ($q) {
                return  $q;
            }])
            ->whereHas('view_request', function ($q) use ($visited_link) {
                return $q->where('status', 1)->whereNotIn('id', $visited_link);;
            })
            ->with(['view_request' => function ($q) use ($visited_link) {
                return $q->where('status', 1)->whereNotIn('id', $visited_link);
            }])
            ->where('status', 1)
            ->where('type', 0)
            ->inRandomOrder()
            ->paginate(2000);


        $site_ads = $ads->map(function ($query) {
            if ($query->visited_links_count + $query->visited_websites_count < $query->view_request->count
                && $query->visited_links_today_count < $query->daily_click
//                && $query->visited_links_count < $query->daily_click
            ) {
                return $query;
            } else {
                return null;
            }


        });
        //  return $site_ads;

       return view('layouts.material.user.ads.site_list', compact('site_ads'));

    }


    private function getSearchAds($type)
    {

        $visited_link = VisitedLink::where('visited_id', getUserId())
            ->where('created_at', '>', getNow()->subHour(2))
            ->where('price', '>', 0)
            ->pluck('view_request_id');


        $ads = Ads::withCount(['visited_links' => function ($q) {
            $q->where('created_at', '>', getNow()->subHour(2));
        }])
            ->whereHas('view_request', function ($q) use ($visited_link) {
                return $q->where('status', 1)->whereNotIn('id', $visited_link);;
            })
            ->with(['view_request' => function ($q) use ($visited_link) {
                return $q->where('status', 1)->whereNotIn('id', $visited_link);
            }])
            ->with(['google_search' => function ($q) {
                return $q->select('id', 'ads_id', 'keyword', 'page_number');
            }])
            ->where('type', $type)
            ->where('status', 1)
            ->paginate(140);


        $search_ads = $ads->map(function ($query) {
            if ($query->visited_links_count < $query->view_request->count && $query->visited_links_count < $query->daily_click) {
                return $query;
            } else {
                return null;
            }


        });


        return $search_ads;
    }

    public function site_search_list($engine)
    {


        switch ($engine) {

            case "google" :
                $url = 'https://www.google.com/search?q=';
                $my_engine = 'گوگل';
                $search_ads = $this->getSearchAds(1);
                break;

            case "bing" :

                $url = 'https://www.bing.com/search?q=';
                $my_engine = 'بینگ';
                $search_ads = $this->getSearchAds(2);
                break;
            case "yahoo" :

                $url = 'https://search.yahoo.com/search?p=';
                $my_engine = 'یاهو';
                $search_ads = $this->getSearchAds(3);
                break;
            case "aparat" :

                $url = 'https://search.yahoo.com/search?p=';
                $my_engine = 'یاهو';
                $search_ads = $this->getSearchAds(4);
                break;
        }

        return view('layouts.material.user.ads.search_list', compact('search_ads', 'url', 'my_engine'));

    }

//    public function site_bing_search_list(Request $request)
//    {
//
//        $visited_link = VisitedLink::where('visited_id', getUserId())
//            ->where('created_at', '>', getToday())
//            ->where('price', '>', 0)
//            ->pluck('view_request_id');
//
//
//        $ads = Ads::withCount(['visited_links' => function ($q) {
//            $q->where('created_at', '>', getToday());
//        }])
//            ->whereHas('view_request', function ($q) use ($visited_link) {
//                return $q->where('status', 1)->whereNotIn('id', $visited_link);;
//            })
//            ->with(['view_request' => function ($q) use ($visited_link) {
//                return $q->where('status', 1)->whereNotIn('id', $visited_link);
//            }])
//            ->with(['google_search' => function ($q) {
//                return $q->select('id', 'ads_id', 'keyword', 'page_number');
//            }])
//            ->where('type', 2)
//            ->where('status', 1)
//            ->paginate(140);
//
//
//        $google_search_ads = $ads->map(function ($query) {
//            if ($query->visited_links_count < $query->view_request->count && $query->visited_links_count < $query->daily_click) {
//                return $query;
//            } else {
//                return null;
//            }
//
//
//        });
//        return view('user.ads.bing_search_list', compact('google_search_ads'));
//
//    }
//
//
//    public function site_yahoo_search_list(Request $request)
//    {
//
//        $visited_link = VisitedLink::where('visited_id', getUserId())
//            ->where('created_at', '>', getToday())
//            ->where('price', '>', 0)
//            ->pluck('view_request_id');
//
//
//        $ads = Ads::withCount(['visited_links' => function ($q) {
//            $q->where('created_at', '>', getToday());
//        }])
//            ->whereHas('view_request', function ($q) use ($visited_link) {
//                return $q->where('status', 1)->whereNotIn('id', $visited_link);;
//            })
//            ->with(['view_request' => function ($q) use ($visited_link) {
//                return $q->where('status', 1)->whereNotIn('id', $visited_link);
//            }])
//            ->with(['google_search' => function ($q) {
//                return $q->select('id', 'ads_id', 'keyword', 'page_number');
//            }])
//            ->where('type', 3)
//            ->where('status', 1)
//            ->paginate(140);
//
//
//        $google_search_ads = $ads->map(function ($query) {
//            if ($query->visited_links_count < $query->view_request->count && $query->visited_links_count < $query->daily_click) {
//                return $query;
//            } else {
//                return null;
//            }
//
//
//        });
//        return view('user.ads.yahoo_search_list', compact('google_search_ads'));
//
//    }


    public function clicki_save(AdsRequest $request)
    {
        $text = getUserId() . "\n" . $request->title . "\n" . "یک آگهی کلیکی ثبت کرد";
        sendMessageToBot($text, ['618723858','288923947']);
        $store_path = '/images/' . getUserId() . '/ads/';

        $image = UpLoad::create('image')
            ->request($request)
            ->target('main_image')
            ->store_path($store_path)
            ->watermark_path('watermark_logo.png')
            ->resizePercentage(80)
            ->resize_percent(75)
            ->makeUpload();


        Ads::create(
            [
                'user_id' => getUserId(),
                'title' => $request->title,
                'link' => $request->link,
                'daily_click' => convert_to_digit($request->daily_click, 'en'),

                'status' => -1,
                'image_path' => $image['image_path'][0],

            ]
        );

        return redirect(route('user.ads.clicki.list'))->with('success', 'آگهی شما با موفقیت ثبت شد');
    }

    public function google_search_save(GoogleSearchRequest $request)
    {

        $text = getUserId() . "\n" . $request->title . "\n" . "یک آگهی جستجو گوگل ثبت کرد";
        sendMessageToBot($text, ['618723858','288923947']);
        $ads = Ads::create(
            [
                'user_id' => getUserId(),
                'title' => $request->title,
                'link' => $request->link,
                'daily_click' => convert_to_digit($request->daily_click, 'en'),
                'status' => -1,
                'type' => $request->engine_type,
                'image_path' => '',

            ]
        );
        GoogleSearch::create(
            [
                'ads_id' => $ads->id,
                'keyword' => $request->keyword,
                'page_number' => $request->page_number,
            ]
        );
        return redirect(route('user.ads.google_search.list'))->with('success', 'آگهی شما با موفقیت ثبت شد');
    }


    public function active($id)
    {

        try {
            $ads = ViewRequest::select('status')->where('user_id', getUserId())->find($id);
            ViewRequest::where('id', $id)->where('user_id', getUserId())->update(['status' => -$ads->status]);
            return response()->json(
                [
                    'status' => 1,
                    'message' => 'my message',
                    'publish' => $ads->status * -1,
                ]
                , 200
            );
        } catch (\Exception $e) {

        }

    }


}
