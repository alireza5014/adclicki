<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\ClickCalculateRequest;
use App\Model\Ads;
use App\Model\Payment;
use App\Model\TempPayment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;
use SoapClient;

class PaymentsController extends Controller
{
    public function list(Request $request)
    {

        $payments = Payment::where('user_id', getUserId())->orderBy('id', 'DESC')->paginate(10);


        if ($request->ajax()) {
            try {
                return view('layouts.material.user.payments.table', compact('payments'))->render();
            } catch (\Throwable $e) {
            }
        }
        return view('layouts.material.user.payments.list', compact('payments'));
    }

    public function buy_click()
    {


        return view('layouts.material.user.payments.buy_click');
    }


    public function click_calculate(ClickCalculateRequest $request)
    {

        $count = convert_to_digit($request->click_count, 'en');
        $price = $count * 7;

        $response = ['status' => 1, 'count' => $count, 'price' => number_format($price)];

        return response()->json($response);

    }


    public function pay(ClickCalculateRequest $request)
    {


        try {

            $request['res_number'] = rand(1111111, 999999999);

            $request['price'] = $request->click_count * 7;

            TempPayment::create(
                [
                    'ref_number' => 0,
                    'res_number' => $request['res_number'],
                    'price' => $request['price'],
                    'user_id' => getUserId(),
                ]
            );


            //extract data from the post
            extract($request->all());

//set POST variables
            $url = 'http://www.gamenetmanager.ir/user/pay_2';


            echo "<form name='myform' id='myform' action='" . $url . "' method='post'>
<input type='hidden' name='price' value='" . $request['price'] . "' />
<input type='hidden' name='res_number' value='" . $request['res_number'] . "' />
<input type='hidden' name='fname' value='" . auth('user')->user()->fname . "' />
<input type='hidden' name='lname' value='" . auth('user')->user()->lname . "' />
<input type='hidden' name='email' value='" . auth('user')->user()->email . "' />
<input type='hidden' name='mobile' value='" . auth('user')->user()->mobile . "' />
</form>
<script>   document.forms['myform'].submit();</script>";

        } catch (Exception $exception) {

        }


//        return $this->call_back($request->click_count);
//        return redirect(route('user.payment.call_back'));
    }


    public function call_back($click_count)
    {


        Payment::where('user_id', getUserId())->create(
            [
                'user_id' => getUserId(),
                'payment_type' => 2,
                'price' => $click_count * 15,
                'click_count' => 0,
                'description' => "پرداخت کاربر - کد پیگیری ۱۲۲۱۲ درگاه",

            ]
        );
        Payment::where('user_id', getUserId())->create(
            [
                'user_id' => getUserId(),
                'payment_type' => 1,
                'price' => -$click_count * 15,
                'click_count' => $click_count,
                'description' => "خرید کلیک",

            ]
        );


        return back();
    }

}
