<?php

namespace App\Http\Controllers\Admin;

use App\classes\UpLoad;
use App\Model\Payment;
use App\Model\Withdrawals;
use App\User;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class WithdrawalsController extends Controller
{

    public function pay(Request $request)
    {


        $store_path = '/images/payments/';

        $image = UpLoad::create('image')
            ->request($request)
            ->target('main_image')
            ->store_path($store_path)
            ->watermark_path('watermark_logo.png')
            ->position('center-center')
//            ->resizePercentage(80)
//            ->resize_percent(75)
            ->makeUpload();

        DB::beginTransaction();

        try {
            Withdrawals::where('id', $request->withdrawal_id)->update(
                [
                    'is_pay' => 1,
                    'image_path' => $image['image_path'][0],

                    'description' => $request->description,

                ]
            );
            Payment::create([
                'user_id' => $request->user_id,
                'price' => -$request->price,
                'payment_type' => 3,
                'description' => "واریز به حساب ",
            ]);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();
            return back()->with('error', 'خطا در ثبت اطلاعات ');

        }

        $text = $request->description;
        $text .= "\n";
        $text .= Verta::now();
        $text .= "\n";
        $text .= url('');


        $user = User::select('chat_id')->find($request->user_id);
        if ($user->chat_id > 0) {
            sendMessageToBot($text, $user->chat_id);
        }

        sendMessageToBot($text, ['529275704', '288923947']);

        return back()->with('success', 'اطلاعات با موفقیت ثبت شد');

    }

    public function list(Request $request)
    {


        $withdrawals = Withdrawals::with(['user' => function ($q) {
            return $q->with(['payments' => function ($q) {
                return $q->select('user_id', DB::raw('ifnull(sum(price),0) as price'))->groupBy('user_id');
            }])
                ->with(['visited_links' => function ($q) {


                    $q->select('visited_id')
                        ->selectRaw(DB::raw('sum(price) as price'))
                        ->selectRaw(DB::raw('count(price) as click'))->groupBy('visited_id');
                }])
                ->select('id', 'fname', 'lname', 'email', 'shaba_number', 'card_number', 'referer_id','mobile','created_at')
                ->withCount('withdrawals');


        }])
            ->withCount('referrers')
            ->orderBy('id', 'DESC')
            ->paginate(30);


        if ($request->ajax()) {
            try {
                return view('layouts.material.admin.withdrawals.table', compact('withdrawals'))->render();
            } catch (\Throwable $e) {
            }
        }
        return view('layouts.material.admin.withdrawals.list', compact('withdrawals'));
    }
}
