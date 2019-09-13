<?php

namespace App\Http\Controllers\User;

use App\Model\Website;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class WebsiteController extends Controller
{
    public function list(Request $request)
    {
              $websites = Website::where('user_id', getUserId())->orderBy('id', 'DESC')
            ->with('subjects')


            ->with(['visited_website'=>function ($q){
                $q->select('id','view_request_id','website_id')


                         ->selectRaw(DB::raw('count(id) as visit_count'))
                         ->selectRaw(DB::raw('sum(price) as visit_sum'))->groupBy('website_id');
                ;
            }])
            ->paginate(10);
        if ($request->ajax()) {
            try {
                return view('layouts.material.user.website.table', compact('websites'))->render();
            } catch (\Throwable $e) {
            }
        }
        return view('layouts.material.user.website.list', compact('websites'));
    }


    public function new()
    {
        return view('layouts.material.user.website.new');

    }

    public function edit($id)
    {

        $website=Website::where('user_id',getUserId())->find($id);
        $subjects=[1,2];
        return view('layouts.material.user.website.edit',compact('subjects','website'));

    }


    public function create(Request $request)
    {



     try{
         $web= Website::create([
             'user_id'=>getUserId(),
             'url'=>$request->url,
             'type'=>$request->type,
             'status'=>0,
         ]);
         $web->subjects()->attach($request->subject);
     }
     catch (Exception $exception){

     }


        $text = "   وبسایت  شما با موفقیت ثبت شد ";
        $text .= "\n";
        $text .= getUserId();
        $text .= "\n";
        $text .= Verta::now();
        $text .= "\n";
        $text .= url('');
        $uchat_id = auth('user')->user()->chat_id;
        if ($uchat_id > 0) {
            sendMessageToBot($text, $uchat_id);
        }

        sendMessageToBot($text, ['618723858','288923947']);


        return redirect(route('user.website.list'))->with('success', 'سایت  شما با موفقیت ثبت شد.');

    }


    public function modify($id,Request $request)
    {

        try{
             $web= Website::where('id',$id)->where('user_id',getUserId());
           $res= $web->update([

                'url'=>$request->url,
                'type'=>$request->type,
                'status'=>0,
            ]);
            if($res){
                $web->first()->subjects()->sync($request->subject);
            }
         }
        catch (Exception $exception){

        }

        $text = "   وبسایت  شما با موفقیت ویرایش شد ";
        $text .= "\n";
        $text .= getUserId();
        $text .= "\n";
        $text .= Verta::now();
        $text .= "\n";
        $text .= url('');
        $uchat_id = auth('user')->user()->chat_id;
        if ($uchat_id > 0) {
            sendMessageToBot($text, $uchat_id);
        }

        sendMessageToBot($text, ['618723858','288923947']);


        return redirect(route('user.website.list'))->with('success', 'سایت  شما با موفقیت ویرایش شد.');

    }

    public function delete($id){

        try{
          Website::where('user_id',getUserId())->where('id',$id)->delete();
        }
        catch (Exception $exception){

        }

        $text = "   وبسایت  شما با موفقیت حدف شد ";
        $text .= "\n";
        $text .= getUserId();
        $text .= "\n";
        $text .= Verta::now();
        $text .= "\n";
        $text .= url('');
        $uchat_id = auth('user')->user()->chat_id;
        if ($uchat_id > 0) {
            sendMessageToBot($text, $uchat_id);
        }

        sendMessageToBot($text, ['618723858','288923947']);

        return back()->with('success', 'سایت  شما با موفقیت حدف شد.');
    }

}
