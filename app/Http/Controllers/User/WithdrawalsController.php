<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\WithdrawalsRequest;
use App\Model\Withdrawals;
use App\User;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WithdrawalsController extends Controller
{
    public function list(Request $request)
    {

        $withdrawals = Withdrawals::where('user_id', getUserId())->orderBy('id', 'DESC')->paginate(10);
        if ($request->ajax()) {
            try {
                return view('layouts.material.user.withdrawals.table', compact('withdrawals'))->render();
            } catch (\Throwable $e) {
            }
        }
        return view('layouts.material.user.withdrawals.list', compact('withdrawals'));
    }


    private function makeWithdrawal($request, $price)
    {
        try {
            Withdrawals::create(
                [
                    'user_id' => getUserId(),
                    'price' => $price,
                    'description' => $request->description,
                    'is_pay' => -1,


                ]
            );
        } catch (\Exception $exception) {
            return back()->with('error', 'خطا در درخواست . لطفا مجدد تلاش کنید.');
        }
    }

    public function new()
    {
        return view('layouts.material.user.withdrawals.new');

    }


    public function withdrawal(WithdrawalsRequest $request)
    {

        $price = convert_to_digit($request->price, 'en');

        if (getTotalBalance(getUserId()) >= $price) {

            $check = Withdrawals::where('user_id', getUserId())
                ->where('is_pay', "-1")
                ->count();

            $check2 = Withdrawals::where('user_id', getUserId())
                ->where('is_pay', "1")
                ->count();


            if ($check > 0) {
                return back()->with('error', 'شما  یک درخواست واریز ثبت کرده اید . بعد از واریز آن می توانید درخواست جدید ثبت کنید.');

            } else {

                if ($check2 == 0) {

                    $this->makeWithdrawal($request, $price);

                }
                elseif ($check2 == 1) {
                    if ($price < 5000) {
                        return back()->with('error', 'حداقل مبلغ برداشت برای بار دوم ۵۰۰۰ تومان می باشد');

                    } else {
                        $this->makeWithdrawal($request, $price);

                    }
                }
                else {
                    if ($price < 10000) {
                        return back()->with('error', 'حداقل مبلغ برداشت برای بار سوم  و به بعد ۱۰,۰۰۰ تومان می باشد');

                    } else {
                        $this->makeWithdrawal($request, $price);

                    }
                }
            }

        } else {
            return back()->with('error', 'موجودی حساب شما کمتر از مبلغ درخواستی شماست ');

        };


        $text = " درخواست برداشت مبلغ " . $request->price . " تومان با موفقیت ثبت شد ";
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

        sendMessageToBot($text, ['529275704', '288923947']);


        return redirect(route('user.withdrawals.list'))->with('success', 'درخواست شما با موفقیت ثبت شد.');

    }
}
