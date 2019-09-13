<?php

namespace App\Http\Controllers\Admin;

use App\classes\UpLoad;
use App\Http\Requests\AdsRequest;
use App\Model\Ads;
use App\Model\ViewRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Mockery\Exception;

class AdsController extends Controller
{


    public function clicki_list(Request $request)
    {

        $publish = Input::get('publish', 0);
        $verify = Input::get('verify', 0);

        $ads = Ads::orderBy('id', 'DESC')
            ->with(['view_request' => function ($q)use ($verify) {

                if ($verify != 0) {
                    return $q->select('id', 'ads_id', 'count', 'status')->where('status', $verify);
                }
                 return $q->select('id', 'ads_id', 'count', 'status');


            }])
            ->with(['user' => function ($q) {
                return $q->select('id', 'fname', 'lname', 'email', 'mobile', 'created_at');
            }])
            ->where('type', 0)

            ->withCount('visited_links')
            ->withCount('visited_websites');
        if ($publish != 0) {
            $ads->where('status', $publish);
        }
        $ads = $ads->paginate(30);

        if ($request->ajax()) {
            try {
                return view('layouts.material.admin.ads.clicki.table', compact('ads'))->render();
            } catch (\Throwable $e) {
            }
        }
        return view('layouts.material.admin.ads.clicki.list', compact('ads'));

    }

    public function google_search_list(Request $request)
    {

        $ads = Ads::orderBy('id', 'DESC')
            ->with(['view_request' => function ($q) {
                return $q->select('id', 'ads_id', 'count', 'status');
            }])
            ->with(['user' => function ($q) {
                return $q->select('id', 'fname', 'lname', 'email', 'mobile', 'created_at');
            }])
            ->withCount('visited_links')
            ->with(['google_search' => function ($q) {
                return $q->select('id', 'ads_id', 'keyword', 'page_number');
            }])
            ->whereIn('type', [1, 2])
            ->paginate(20);

        if ($request->ajax()) {
            try {
                return view('layouts.material.admin.ads.google_search.table', compact('ads'))->render();
            } catch (\Throwable $e) {
            }
        }
        return view('layouts.material.admin.ads.google_search.list', compact('ads'));

    }


    public function delete($id)
    {
        try {

            Ads::where('id', $id)->delete();
        } catch (Exception $exception) {
            return back()->with('success', 'خطا در حذف');

        }
        return back()->with('success', 'با موفقیت حذف شد');
    }

    public function active($id)
    {

        try {
            $ads = ViewRequest::select('status')->find($id);
            ViewRequest::where('id', $id)->update(['status' => -$ads->status]);
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

    public function confirm($id)
    {

        try {
            $ads = Ads::with('user')->select('user_id','status')->find($id);
            if($ads->status==-1){
                $text="آگهی شما باموفقیت تایید شد";
                $text.="\n";
                $text.=verta(Carbon::now());
                $text.="\n";
                $text.=url('');
                $text.="\n";
                $subject = "تایید آگهی " . $ads->title;
                $text.="\n";

                SEND_MESSAGE_WITH_MAIL($ads->user->fname . " " . $ads->user->lname, $ads->user->email, $subject, $text);

            }

            Ads::where('id', $id)->update(['status' => -$ads->status]);


            return response()->json(
                [
                    'status' => 1,
                    'message' => 'my message',
                    'publish' => $ads->status * -1,
                ]
                , 200
            );
        } catch (\Exception $e) {
            file_put_contents("errors.txt", $e->getMessage().$ads);

        }

    }
}
