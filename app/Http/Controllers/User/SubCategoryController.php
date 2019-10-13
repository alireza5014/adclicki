<?php

namespace App\Http\Controllers\User;

use App\Model\Subcategory;
use App\Model\TempPayment;
use App\Model\VisitedLink;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;


class SubCategoryController extends Controller
{

    public function refresh($id)
    {
        try{
            $sub= Subcategory::where('id',$id)->select('refresh_count')->first();
            if($sub['refresh_count']>0) {

                $visited_ids = VisitedLink::inRandomOrder()->take(1)->distinct()->where('created_at', '>', getNow()->subHour(24 * 1))->pluck('visited_id');
                Subcategory::where('id', $id)->where('user_id', getUserId())->update([

                    'referrer_id' => $visited_ids[0],
                    'refresh_count' => DB::raw('refresh_count -1'),

                ]);
            }
            else{
                return back()->with('error','شما ریفرش های خود را انجام داده اید.');

            }
        }
        catch (Exception $e){
            return back()->with('error','خطا');

        }

        return back()->with('success','تغییر زیر مجموعه با موفقیت انجام شد');
    }


    public function list(Request $request)
    {

        $referer_price = [];
        $subcategories = Subcategory::with('user')->where('user_id', getUserIdAfterChecking())->paginate(20);
        foreach ($subcategories as $subcategory) {
            $referer_price[] = VisitedLink::where('visited_id', $subcategory['referrer_id'])
                ->where('created_at', '>=', $subcategory['created_at'])
                ->where('created_at', '<=', $subcategory['expire_date'])
                ->sum('referer_price');
        }
        if ($request->ajax()) {
            try {

                return view('layouts.material.user.subcategory.table', compact('subcategories', 'referer_price'))->render();
            } catch (\Throwable $e) {
            }
        }
        return view('layouts.material.user.subcategory.list', compact('subcategories', 'referer_price'));
    }


    public function new()
    {
        return view('layouts.material.user.subcategory.new');
    }

    public function create(Request $request)
    {
        $count = $request->hire_count;
        $time = $request->hire_time;
        $buy_type = $request->buy_type;
        $price = $count * $time * getHirePrice();

        if ($buy_type == 1) {
            $this->payOnLine($price, $count, $time);

        } elseif ($buy_type == 2) {
            $this->payFromBalance($price, $count, $time);
        }
    }

    private function payFromBalance($price, $count, $time)
    {

    }

    private function payOnLine($price, $count, $time)
    {
        try {

            $res_number = rand(1111111, 999999999);

            TempPayment::create(
                [
                    'ref_number' => 0,
                    'res_number' => $res_number,
                    'price' => $price,
                    'count' => $count,
                    'user_id' => getUserId(),
                    'expire_date' => getNow()->addMonths($time),
                ]
            );
//set POST variables
            $url = 'http://www.gamenetmanager.ir/user/pay_3';


            echo "<form name='myform' id='myform' action='" . $url . "' method='post'>
            
 
<input type='hidden' name='price' value='" . $price . "' />
<input type='hidden' name='res_number' value='" . $res_number . "' />
<input type='hidden' name='fname' value='" . auth('user')->user()->fname . "' />
<input type='hidden' name='lname' value='" . auth('user')->user()->lname . "' />
<input type='hidden' name='email' value='" . auth('user')->user()->email . "' />
<input type='hidden' name='mobile' value='" . auth('user')->user()->mobile . "' />
</form>
<script>   document.forms['myform'].submit();</script>";

        } catch (\Exception $exception) {
        }

    }
}
