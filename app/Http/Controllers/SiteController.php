<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;

use App\Http\Requests\RecoveryRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Model\Ads;
use App\Model\Notification;
use App\Model\Payment;
use App\Model\Subcategory;
use App\Model\TempPayment;
use App\Model\ViewRequest;
use App\Model\VisitedLink;
use App\Model\VisitedWebsite;
use App\Model\Website;
use App\Model\Withdrawals;
use App\Setting;
use App\User;


use Carbon\Carbon;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use Mockery\Exception;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;
use SoapClient;
use Telegram\Bot\Api;
use Telegram\Bot\Exceptions\TelegramSDKException;

use MetzWeb\Instagram\Instagram;

class SiteController extends Controller
{

    private $telegram;



//    public function instagram_callback(Request $request)
//    {
//        try {
//            $instagram = new Instagram(array(
//                'apiKey' => '6e3e0390a6f04498b94ff413385f268d',
//                'apiSecret' => '65d07a12c7484563a32f410cdc6c1062',
//                'apiCallback' => 'https://www.adclicki.ir/instagram_callback'
//            ));
//
////            $code = $_GET['code'];
//            $data = $instagram->getOAuthToken($request->code);
//
////              'Your username is: ' . $data->user->username;
//
//            $instagram->setAccessToken($data);
//
//// get all user likes
//              $likes = $instagram->getUserFollower();
//
//// take a look at the API response
//            echo '<pre>';
//              var_dump($likes);
//            echo '<pre>';
//
//        } catch (\Exception $e) {
//
//            return $e->getMessage();
//        }
//
//    }
//
//    public function instagarm1()
//    {
//
//
//        try {
//            $instagram = new Instagram(array(
//                'apiKey' => '6e3e0390a6f04498b94ff413385f268d',
//                'apiSecret' => '65d07a12c7484563a32f410cdc6c1062',
//                'apiCallback' => 'https://www.adclicki.ir/instagram_callback'
//            ));
//
//            return "<a href='{$instagram->getLoginUrl()}'>Login with Instagram1Instagram1Instagram1</a>";
//
//        } catch (\Exception $e) {
//        }
//
//
//    }

//    public function instagram_callback(INSTAGRAM_ME $instagram)
//    {
//        //        return $instagram->getLoginUrl();
//        $access_token = '11199822384.1677ed0.c04b0579714742c1a20cce901ecd5a1d';
//        $data = $instagram->get('v1/users/20458895057/relationship', ['access_token' => $access_token]);
//        // $data = $instagram->get('v1/users/' $user-id, ['access_token' => $access_token]);
//        return $data;
//    }
    public function login_via_admin($user_id)
    {

        $user_id = base64_decode($user_id);
        Auth('user')->loginUsingId($user_id);

        return redirect(route('user.home'));

    }

    public function test2()
    {

//     $a=   VisitedLink::where('created_at','>','2019-09-04 00:00:00')->where('created_at','<','2019-09-04 23:59:59')->groupBy('visited_id')->pluck('id');
//
//      $b= $a->toArray();
//
//     VisitedLink::whereIn('id',$b)->update(['price'=>2000]);
        return 11;
        $stream_key = 'live2';
        header("Content-Type: text/html; charset=UTF-8");

        date_default_timezone_set('Asia/Tehran');//set the time zone if server time-zone is not correct


        $wowzastart = time();
        $wowzaend = strtotime(date('d-m-Y H:i')) + 1800;
        $secret = '54000bc701d99618';
        $wowzatoken = 'wowzatoken';
        $ip = getIP();
// $ip='84.241.26.193';

        $hashstr = hash('sha256', 'shivaava/live2?' . $ip . "&" . $secret . '&' . $wowzatoken . 'endtime=' . $wowzaend . '&' . $wowzatoken . 'starttime=' . $wowzastart . '', true); # IMPORTANT to set third parameter equals to TRUE
        $usableHash = strtr(base64_encode($hashstr), '+/', '-_');

        return "http://185.8.174.23:1935/shivaava/" . $stream_key . "/playlist.m3u8?" . $wowzatoken . "endtime=" . $wowzaend . "&" . $wowzatoken . "starttime=" . $wowzastart . "&" . $wowzatoken . "hash=" . $usableHash . "";


    }


    public function get_popup()
    {


        $from_url = '';
        if (request()->headers->get('referer')) {
            $from_url = rtrim(request()->headers->get('referer'), '/');
            $url1 = parse_url($from_url);
            $from_url = $url1['scheme'] . "://" . $url1['host'];
        }

        $web = Website::where('url', $from_url)
            ->where('status', 1)
            ->where('type', "popup")
            ->first();

        if ($web) {
            return "var a = document.createElement('a');
var linkText = document.createTextNode('');
a.appendChild(linkText);
a.title = '';
a.target = '_blank';
 
a.href = '1111';
a.id = 'my_id';

var img = new Image();  
img.src = 'rrrr'; 
img.setAttribute('width', 468);
img.setAttribute('height', 60);
 
img.setAttribute('style', 'z-index:9999;');
a.appendChild(img);
document.getElementById('adclicki_popup').appendChild(a);";

        }
        return null;
    }

    public function get_banner()
    {


        $from_url = '';
        if (request()->headers->get('referer')) {
            $from_url = rtrim(request()->headers->get('referer'), '/');
            $url1 = parse_url($from_url);
            $from_url = $url1['scheme'] . "://" . $url1['host'];
        }

        $web = Website::where('url', $from_url)
            ->where('status', 1)
            ->where('type', "banner")
            ->first();
        if ($web) {
            $view = ViewRequest::with(['ad' => function ($q) {
                $q->where('status', 1);
            }])
                ->where('status', 1)
                ->inRandomOrder()
                ->first();


            return "var a = document.createElement('a');
var linkText = document.createTextNode('');
a.appendChild(linkText);
a.title = '';
a.target = '_blank';
 
a.href = '" . url("site/test/" . $view->id . "/" . $view->ad->id . "/" . $web->id) . "';
a.id = 'my_id';

var img = new Image();  
img.src = '" . url($view->ad->image_path) . "'; 
img.setAttribute('width', 468);
img.setAttribute('height', 60);
 
img.setAttribute('style', 'z-index:9999;');
a.appendChild(img);
document.getElementById('adclicki').appendChild(a);";
        }


    }

    public function test($view_request_id, $ads_id, $website_id)
    {

        $ad = Ads::select('link')->find($ads_id);
        VisitedWebsite::updateOrCreate(['ip' => getIP(), 'view_request_id' => $view_request_id, 'ads_id' => $ads_id], [
            'ip' => getIP(),
            'browser' => getBrowser(),
            'os' => getOS(),
            'view_request_id' => $view_request_id,
            'ads_id' => $ads_id,
            'website_id' => $website_id,
            'price' => 5,
            'type' => 'banner',
            'referrer_price' => 1,
        ]);

        return redirect($ad->link);

    }

    public function __construct()
    {
        try {
            $this->telegram = new Api(env('TELEGRAM_BOT_TOKEN'));

        } catch (TelegramSDKException $e) {

        }
    }

    public function verify()
    {


        $MerchantID = '5590002';
        $Password = 'hUksJQxBR';


        if (isset($_POST['status']) && $_POST['status'] == 100) {


            $Status = $_POST['status'];

            $Refnumber = $_POST['refnumber'];
            $Resnumber = $_POST['resnumber'];

            $pay = TempPayment::where('res_number', $Resnumber)->first();
            $Price = $pay['price']; //Price By Toman

//Your Order ID

            $client = new SoapClient('http://merchant.arianpal.com/WebService.asmx?wsdl');

            $res = $client->VerifyPayment(array("MerchantID" => $MerchantID, "Password" => $Password, "Price" => $Price, "RefNum" => $Refnumber));


            $Status = $res->verifyPaymentResult->ResultStatus;
            $PayPrice = $res->verifyPaymentResult->PayementedPrice;

            if ($Status == 'Success')// Your Peyment Code Only This Event
            {
                try {
                    TempPayment::where('res_number', $Resnumber)->update([


                        'price' => $Price,
                        'ref_number' => $Refnumber,
                    ]);


                    Payment::create(
                        [
                            'user_id' => $pay->user_id,
                            'payment_type' => 2,
                            'price' => $Price,
                            'click_count' => 0,
                            'description' => "پرداخت کاربر - کد پیگیری  " . $Resnumber . "  درگاه آرین پال(خرید زیر کلیک)",


                        ]
                    );
                    Payment::create(
                        [
                            'user_id' => $pay->user_id,
                            'payment_type' => 1,
                            'price' => -$Price,
                            'click_count' => $Price / 10,
                            'description' => "خرید کلیک",

                        ]
                    );

                } catch (Exception $exception) {
                    file_put_contents('GGGGGG.txt', $exception->getMessage());
                }
                return redirect(route('user.payments.list'))->with('success', "	پرداخت با موفقیت انجام شد ، شماره رسید پرداخت : ' . $Refnumber . ' ،  مبلغ پرداختی : ' . $PayPrice . ' !");

            } else {

                return redirect(route('user.payments.list'))->with('error', "خطا در پردازش عملیات پرداخت ");

            }
        } else {
            return redirect(route('user.payments.list'))->with('error', "بازگشت از عمليات پرداخت، خطا در انجام عملیات پرداخت ( پرداخت ناموق ) ! ");

        }

    }


    public function verify_3()
    {


        $MerchantID = '5590002';
        $Password = 'hUksJQxBR';


        if (isset($_POST['status']) && $_POST['status'] == 100) {


            $Status = $_POST['status'];

            $Refnumber = $_POST['refnumber'];
            $Resnumber = $_POST['resnumber'];

            $pay = TempPayment::where('res_number', $Resnumber)->first();
            $Price = $pay['price']; //Price By Toman

//Your Order ID

            $client = new SoapClient('http://merchant.arianpal.com/WebService.asmx?wsdl');

            $res = $client->VerifyPayment(array("MerchantID" => $MerchantID, "Password" => $Password, "Price" => $Price, "RefNum" => $Refnumber));


            $Status = $res->verifyPaymentResult->ResultStatus;
            $PayPrice = $res->verifyPaymentResult->PayementedPrice;

            if ($Status == 'Success')// Your Peyment Code Only This Event
            {
                try {
                    TempPayment::where('res_number', $Resnumber)->update([

                        'price' => $Price,
                        'ref_number' => $Refnumber,
                    ]);


                    Payment::create(
                        [
                            'user_id' => $pay->user_id,
                            'payment_type' => 2,
                            'price' => $Price,
                            'click_count' => 0,
                            'description' => "پرداخت کاربر - کد پیگیری  " . $Resnumber . "  درگاه آرین پال(خرید زیر مجموعه)",

                        ]
                    );
                    Payment::create(
                        [
                            'user_id' => $pay->user_id,
                            'payment_type' => 10,
                            'price' => -$Price,
                            'click_count' => 0,
                            'description' => "خرید زیر مجموعه",

                        ]
                    );


                    $visited_ids = VisitedLink::inRandomOrder()->take($pay->count)->distinct()->where('created_at', '>', getNow()->subHour(24 * 2))->pluck('visited_id');

                    $visited_ids = $visited_ids->toArray();
                    for ($i = 0; $i < sizeof($visited_ids); $i++) {
                        Subcategory::create([
                            'refresh_count' => 10,
                            'price' => $Price,
                            'expire_date' => $pay->expire_date,
                            'user_id' => $pay->user_id,
                            'referrer_id' => $visited_ids[$i],

                        ]);
                    }


                } catch (Exception $exception) {
                    file_put_contents('GGGGGG.txt', $exception->getMessage());
                }
                return redirect(route('user.payments.list'))->with('success', "	پرداخت با موفقیت انجام شد ، شماره رسید پرداخت : ' . $Refnumber . ' ،  مبلغ پرداختی : ' . $PayPrice . ' !");

            } else {

                return redirect(route('user.payments.list'))->with('error', "خطا در پردازش عملیات پرداخت ");

            }
        } else {
            return redirect(route('user.payments.list'))->with('error', "بازگشت از عمليات پرداخت، خطا در انجام عملیات پرداخت ( پرداخت ناموق ) ! ");

        }

    }


    public function login(LoginRequest $request)
    {


        $message = 'نام کاربری یا رمز ورود اشتباه است';
        $authentication = false;
        $redirect = route('user.home');


        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // if successful, then redirect to their intended location
            $message = '';
            $authentication = true;


            $this->login_notification($request->email);


        }


        return [
            'authentication' => $authentication, 'message' => $message, 'redirect' => $redirect];
    }


    private function checkLoginNotification()
    {
        return (getUserNotification()['login'] == 1) ? true : false;
    }

    private function checkRegisterRefererNotification()
    {
        return (getUserNotification()['register_referer'] == 1) ? true : false;
    }

    private function register_referer_notification($request)
    {
        if ($this->checkRegisterRefererNotification()) {

            if ($request['referer_id'] > 0) {
                $user = User::where('id', $request['referer_id'])->select('chat_id')->first();

                $text = "با سلام !";
                $text .= "\n";
                $text .= " در تاریخ ";
                $text .= "\n";
                $text .= Verta::now();
                $text .= "\n";
                $text .= 'کاربر ' . $request->fname . " " . $request->lname . "زیر مجموعه شما قرار گرفت.";
                $text .= "\n";
                $text .= "از این پس " . getSetting('referer_percent')['referer_percent'] . " درصد از درآمد ایشان به شما تعلق خواهد گرفت.";
                $text .= "\n";
                $text .= url('');


                sendMessageToBot($text, $user->chat_id);


            }
        }

    }

    private function login_notification($email)
    {

//        sendMessageToAdmin($email . "\n" . ' وارد حساب کاربری خود شد ');
        if ($this->checkLoginNotification()) {

            $text = "شما در تاریخ";
            $text .= "\n";
            $text .= Verta::now();
            $text .= "\n";
            $text .= "ip: " . getIP();
            $text .= "\n";
            $text .= "os: " . getOS();
            $text .= "\n";
            $text .= "browser: " . getBrowser();
            $text .= "\n";
            $text .= "با موفقیت وارد حساب کاربری خود شدید.";
            $text .= "\n";
            $text .= url('');


            sendMessageToBot($text, auth('user')->user()->chat_id);

            SEND_MESSAGE_WITH_MAIL(auth('user')->user()->fname . " " . auth('user')->user()->lname, auth('user')->user()->email, 'ورود به حساب ادکلیکی', $text);

        }

    }

    public function register(RegisterRequest $request)
    {
        sendMessageToBot($request['fname'] . " " . $request['lname'] . " ثبت نام کرد ", admin_bot_id());


        try {

            ($request->mobile != '') ? $mobile = $request->mobile : $mobile = rand(1111111, 99999999);
            $user = User::create([
                'fname' => $request['fname'],
                'lname' => $request['lname'],
                'email' => $request['email'],
                'shaba_number' => $request['shaba_number'],
                'card_number' => $request['card_number'],
                'bank_name' => $request['bank_name'],
                'ip' => getIP(),
                'mobile' => $mobile,
                'code_melli' => rand(10000, 2000000000),
                'referer_id' => $request['referer_id'],
                'image_path' => "images/users/profile.png",
                'type' => 0,
                'activity_type' => 2,
                'device' => getOS(),
                'is_admin' => 0,
                'country' => ip_info(getIP(), "Country"),
                'password' => Hash::make(trim($request['password'])),
            ]);


            Notification::create(
                [
                    'user_id' => $user->id
                ]
            );
            Auth('user')->loginUsingId($user->id);


            $this->register_referer_notification($request);


            $message = 'به سایت اد کلیکی خوش آمدید';
            $message .= "\n";
            $message .= "آدرس سایت ادکلیکی :" . url('');
            SEND_MESSAGE_WITH_MAIL($request['fname'] . " " . $request['lname'], $request['email'], 'عضویت در ادکلیکی', $message);

            return ['authentication' => true, 'redirect' => route('user.home')];


        } catch (\Exception $exception) {

            return ['authentication' => false, 'redirect' => $exception->getMessage()];

        }
    }


    public function home()
    {

//        $auth = base64_encode("username:password");
//        $context = stream_context_create([
//            "http" => [
//                "header" => "Authorization: Basic $auth"
//            ]
//        ]);
//        $homepage = file_get_contents("http://example.com/file", false, $context );

//        return $instagram->getLoginUrl();
        $setting = Setting::first();

        return view('layouts.site1.home', compact('setting'));
    }

    public function faq()
    {


        return view('layouts.site1.faq');
    }

    public function terms()
    {


        return view('layouts.site1.terms');
    }

    public function users()
    {
        $users = User::orderBy('id', 'DESC')->withCount('visited_links')->withCount('referers')->paginate(50);
        return view('site.users', compact('users'));
    }

    public function payments()
    {
        $payments = Withdrawals::with(['user' => function ($q) {
            return $q->select('id', 'fname', 'lname', 'email', 'created_at', 'ip');
        }])->where('is_pay', 1)->orderBy('id', 'DESC')->paginate(200);
        return view('layouts.site1.payments', compact('payments'));
    }

    public function contact_us()
    {
        $contact_us = [];
        return view('layouts.site1.contact_us', compact('contact_us'));
    }

    public function learning()
    {
        $learning = [];
        return view('site.learning', compact('learning'));
    }


    public function ads_popup()
    {
        $data = [];
        return view('layouts.site1.ads.popup', compact('data'));
    }

    public function ads_search()
    {
        $data = [];
        return view('layouts.site1.ads.search', compact('data'));
    }

    public function ads_clicki()
    {
        $data = [];
        return view('layouts.site1.ads.clicki', compact('data'));
    }

    public function ads_tariffs()
    {
        $data = [];
        return view('layouts.site1.ads.tariffs', compact('data'));
    }

    public function recover_password()
    {
        return view('layouts.site1.recover_password');
    }

    public function reset_password()
    {

        $recovery_link = Input::get('recovery_link');
        $user = User::where('recovery_link', $recovery_link)->first();
        if ($user) {
            return view('layouts.site1.reset_password', compact('user'));

        }
        return view('layouts.site1.error_reset_password');


    }

    public function get_recovery_code(RecoveryRequest $request)
    {
        $u = User::where('email', $request->email)->update(['recovery_link' => Str::random(32)]);


        if ($u) {
            $user = User::where('email', $request->email)->first();

            $recovery_link = url('reset_password') . "?recovery_link=" . $user->recovery_link;
            SEND_RECOVERY_MAIL($user->fname . " " . $user->lname, $user->email, $recovery_link);
            return ['status' => 1, 'redirect' => url(''), 'message' => 'لینک بازیابی به ایمیل ' . $request->email . ' ارسال شد '];

        }
        return ['status' => 0, 'message' => 'هیچ کاربری با این ایمیل ثبت تام نکرده است'];


    }

    public function do_reset_password(ResetPasswordRequest $request)
    {
        $u = User::where('recovery_link', $request->recovery_link)->first();


        if ($u) {
            User::where('recovery_link', $request->recovery_link)->update(['password' => Hash::make($request->password), 'recovery_link' => Str::random(32)]);

            Auth('user')->loginUsingId($u->id);

            return ['status' => 1, 'message' => 'رمز ورود شما با موفقیت تغییر یافت', 'redirect' => url('user/home')];
        }
        return ['status' => 0, 'message' => 'خطا در تغییر رمز ورود'];


    }

}
