<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\ViewRequestRequest;
use App\Model\Ads;
use App\Model\Payment;
use App\Model\ViewRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ViewRequestController extends Controller
{

    // Allocation== تخصیص
    private function getUserTotalClickCount($buy_type)
    {
        switch ($buy_type) {
            case 1:
                return getTotalClick();
                break;
            case 2:
                return getTotalBalance(getUserId()) / 7;
                break;

            default :
                return 0;
        }
    }

    public function save(ViewRequestRequest $request)
    {
        try {
            $count = convert_to_digit($request->count, 'en');


            $ads = Ads::select('title', 'type')->find($request->ads_id);

            switch ($ads->type) {
                case 0:
                    $total_click = $this->getUserTotalClickCount($request->buy_type);
                    $zarib = 1;

                    $description = "تخصیص  $count  عدد کلیک به آگهی $ads->title  کد:    $request->ads_id ";

                    break;
// google
                case 1:
                    $total_click = $this->getUserTotalClickCount($request->buy_type) / 5;
                    $zarib = 5;
                    $description = "تخصیص  $count  عدد جستجو گوگل به آگهی $ads->title  کد:    $request->ads_id ";
                    break;


                /// bing
                case 2:
                    $total_click = $this->getUserTotalClickCount($request->buy_type) / 5;
                    $zarib = 5;
                    $description = "تخصیص  $count  عدد جستجو بینگ به آگهی $ads->title  کد:    $request->ads_id ";
                    break;

            }
            if ($total_click >= $count) {


                ViewRequest::updateOrCreate(['ads_id' => $request->ads_id],
                    [
                        'count' => DB::raw('count+' . $count),
                        'ads_id' => $request->ads_id,
                        'user_id' => getUserId(),
                        'status' => 1,
                    ]
                );

                if($request->buy_type==1) {
                    Payment::where('user_id', getUserId())->create(
                        [
                            'user_id' => getUserId(),
                            'payment_type' => 1,
                            'price' => 0,
                            'click_count' => -$count * $zarib,
                            'description' => $description." (تخصیص از طریق موجودی کلیک) ",


                        ]
                    );
                }
                else
                {
                    Payment::where('user_id', getUserId())->create(
                        [
                            'user_id' => getUserId(),
                            'payment_type' => 1,
                            'price' => -$count * $zarib*7,
                            'click_count' => 0,
                            'description' => $description." (تخصیص از طریق موجودی کل) ",

                        ]
                    );
                }

                $response = ['status' => 1, 'message' => 'درخواست شما با موفقیت ثبت شد.'];
            } else {
                $response = ['status' => 2, 'message' => "موجودی حساب شما کمتر از حد مجاز می باشد. بعد از شارژ حساب خود نسبت به تخصیص کلیک اقدام فرمایید. " . "<a href='" . route('user.payments.buy.click') . "' class='btn btn-xs btn-success'>خرید شارژ</a>"];

            }
        } catch (\Exception $exception) {
            $response = ['status' => 0, 'message' => 'خطا ! مجدد تلاش کنید.' . $exception->getMessage()];


        }

        return response()->json($response);
    }


}
