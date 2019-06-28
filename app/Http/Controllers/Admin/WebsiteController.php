<?php

namespace App\Http\Controllers\Admin;

use App\Model\Website;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class WebsiteController extends Controller
{
    public function list(Request $request)
    {
         $websites = Website::with('user')->orderBy('id', 'DESC')
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
                return view('layouts.material.admin.website.table', compact('websites'))->render();
            } catch (\Throwable $e) {
            }
        }
        return view('layouts.material.admin.website.list', compact('websites'));
    }


    public function new()
    {
        return view('layouts.material.admin.website.new');

    }

    public function edit($id)
    {

        $website=Website::with('user')->with('subjects')->find($id);

         $subjects=$website->subjects->pluck('id')->toArray();
        return view('layouts.material.admin.website.edit',compact('subjects','website'));

    }


    public function create(Request $request)
    {



     try{
         $web= Website::create([
             'user_id'=>$request->user_id,
             'url'=>$request->url,
             'type'=>$request->type,
             'status'=>$request->status,

         ]);
         $web->subjects()->attach($request->subject);
     }
     catch (Exception $exception){

     }

        return redirect(route('admin.website.list'))->with('success', 'سایت  شما با موفقیت ثبت شد.');

    }


    public function modify($id,Request $request)
    {


        try{
             $web= Website::where('id',$id);
           $res= $web->update([

                'user_id'=>$request->user_id,
                'url'=>$request->url,
                'type'=>$request->type,
               'status'=>$request->status,

           ]);
            if($res){
                $web->first()->subjects()->sync($request->subject);
            }
         }
        catch (Exception $exception){

        }

        return redirect(route('admin.website.list'))->with('success', 'سایت  شما با موفقیت ویرایش شد.');

    }

    public function delete($id){

        try{
          Website::where('id',$id)->delete();
        }
        catch (Exception $exception){

        }

        return back()->with('success', 'سایت  شما با موفقیت حدف شد.');
    }

}
