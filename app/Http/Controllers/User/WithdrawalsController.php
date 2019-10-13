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


    private function makeWithdrawal($description, $price,$code)
    {
        try {
            Withdrawals::updateOrCreate(['is_verify'=>0,'is_pay'=>-1,'user_id'=>getUserId()],
                [
                    'user_id' => getUserId(),
                    'price' => $price,
                    'description' => $description,
                    'is_pay' => -1,
                    'is_verify' => 0,
                    'code' =>$code,


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


    private function payment_check($is_pay,$is_verify)
    {
        return Withdrawals::where('user_id', getUserId())
            ->where('is_pay', $is_pay)
            ->where('is_verify', $is_verify)
            ->count();
    }

    public function withdrawal(WithdrawalsRequest $request)
    {

        $price = convert_to_digit($request->price, 'en');

        if (getTotalBalance(getUserId()) >= $price) {

            $check = $this->payment_check("-1",1);
            $check2 = $this->payment_check("1",1);


            if ($check > 0) {
                return back()->with('error', 'شما  یک درخواست واریز ثبت کرده اید . بعد از واریز آن می توانید درخواست جدید ثبت کنید.');

            } else {

                if ($check2 == 0) {
                    if ($price < 1000) {
                        return back()->with('error', 'حداقل مبلغ برداشت برای بار اول ۱۰۰۰ تومان می باشد');

                    }
                }

               elseif ($check2 == 1) {
                    if ($price < 5000) {
                        return back()->with('error', 'حداقل مبلغ برداشت برای بار دوم ۵۰۰۰ تومان می باشد');

                    }
                }
                else {
                    if ($price < 10000) {
                        return back()->with('error', 'حداقل مبلغ برداشت برای بار سوم  و به بعد ۱۰,۰۰۰ تومان می باشد');

                    }
                }
                $code=rand(10000,99999);
                $this->makeWithdrawal($request->description, $request->price,$code);

                $this->sendVerifyCodeWithEmailAndTelegram($code);
            }

        } else {
            return back()->with('error', 'موجودی حساب شما کمتر از مبلغ درخواستی شماست ');

        };



        return redirect(route('user.withdrawals.view_verify'))->with('success', 'کد تایید به ایمیل شما ارسال شد');

    }


    public function view_verify()
    {


        return view('layouts.material.user.withdrawals.verify');

    }
    public function verify(Request $request)
    {


         $w = Withdrawals::where('user_id', getUserId())->where('is_verify', 0)->where('is_pay', -1)->first();
        if ($w) {
            if ($request->code == $w->code) {

                Withdrawals::where('user_id', getUserId())
                    ->where('is_verify', 0)
                    ->where('is_pay', -1)
                    ->where('code', $request->code)
                    ->update([
                        'code' => rand(10000, 99999),
                        'is_verify' => 1
                    ]);
                $this->sendMessageWithMailAndTelegram($w->price);
                return redirect(route('user.withdrawals.list'))->with('success', 'درخواست شما با موفقیت ثبت شد.');

            }

        }
        return redirect(route('user.withdrawals.view_verify'))->with('error', 'کد تایید اشتباه می باشد');


    }

    private function sendMessageWithMailAndTelegram($price)
    {
        $text = " درخواست برداشت مبلغ " . $price . " تومان با موفقیت ثبت شد ";
        $text .= "\n";
        $text .= "در اسرع وقت به حساب شما واریز خواهد شد";
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

        sendMessageToBot($text, admin_bot_id());
        SEND_MESSAGE_WITH_MAIL(auth('user')->user()->fname . " " . auth('user')->user()->lname, auth('user')->user()->email, "درخواست برداشت مبلغ", $text);

    }


    private function sendVerifyCodeWithEmailAndTelegram($code)
    {

        $text = "کد تایید برای درخواست وجه در سایت اد کلیکی" . $code . " می باشد. ";
        $text .= "\n";
        $text .= Verta::now();
        $text .= "\n";
        $text .= url('');
        $uchat_id = auth('user')->user()->chat_id;

        if ($uchat_id > 0) {
            sendMessageToBot($text, $uchat_id);
        }

        sendMessageToBot($text, admin_bot_id());
        SEND_MESSAGE_WITH_MAIL(auth('user')->user()->fname . " " . auth('user')->user()->lname, auth('user')->user()->email, "درخواست برداشت مبلغ", $text);


    }
}
