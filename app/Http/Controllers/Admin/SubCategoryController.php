<?php

namespace App\Http\Controllers\Admin;

use App\Model\Subcategory;
use App\Model\VisitedLink;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Mockery\Exception;

class SubCategoryController extends Controller
{
    public function list(Request $request)
    {

        $user_id=Input::get('user_id',0);
        $referer_price = [];
        $subcategories = Subcategory::with('user')->where('user_id', $user_id)->paginate(20);
        foreach ($subcategories as $subcategory) {
            $referer_price[] = VisitedLink::where('visited_id', $subcategory['referrer_id'])
                ->where('created_at', '>=', $subcategory['created_at'])
                ->where('created_at', '<=', $subcategory['expire_date'])
                ->sum('referer_price');
        }
        if ($request->ajax()) {
            try {

                return view('layouts.material.admin.subcategory.table', compact('subcategories', 'referer_price'))->render();
            } catch (\Throwable $e) {
            }
        }
        return view('layouts.material.admin.subcategory.list', compact('subcategories', 'referer_price'));
    }

    public function refresh($id)
    {
      try{
          $visited_ids = VisitedLink::inRandomOrder()->take(1)->distinct()->where('created_at', '>', getNow()->subHour(24 * 1))->pluck('visited_id');
          Subcategory::where('id',$id)->update([

              'referrer_id' => $visited_ids[0],

          ]);
      }
      catch (Exception $e){
          return back()->with('error','ERROR');

      }

        return back()->with('success','OK');
    }


    public function add_subcategory()
    {
        $visited_ids = VisitedLink::inRandomOrder()->take(70)->distinct()->where('created_at', '>', getNow()->subHour(24 * 2))->pluck('visited_id');

        $visited_ids = $visited_ids->toArray();
        for ($i = 0; $i < sizeof($visited_ids); $i++) {
            Subcategory::create([
                'refresh_count' => 10 * 1,
                'price' => 700,
                'expire_date' => "1398-08-12 00:31:01",
                'user_id' => 2162,
                'referrer_id' => $visited_ids[$i],

            ]);
        }
    }
}
