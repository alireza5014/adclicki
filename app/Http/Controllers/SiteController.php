<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;

use App\Http\Requests\RegisterRequest;
use App\Model\Ads;
use App\Model\Notification;
use App\Model\Payment;
use App\Model\TempPayment;
use App\Model\ViewRequest;
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
use Mockery\Exception;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;
use SoapClient;
use Telegram\Bot\Api;
use Telegram\Bot\Exceptions\TelegramSDKException;


class SiteController extends Controller
{

    private $telegram;


    public function get_banner()
    {

        $from_url = rtrim(request()->headers->get('referer'), '/');
        $url1 = parse_url($from_url);
        $from_url = $url1['scheme'] . "://" . $url1['host'];

        $web = Website::where('url', $from_url)->where('status', 1)->first();
        if ($web) {
            $view = ViewRequest::with(['ad'])
                ->where('status', 1)
                ->inRandomOrder()
                ->first();


            return "var a = document.createElement('a');
var linkText = document.createTextNode('');
a.appendChild(linkText);
a.title = '';
a.target = '_blank';
 
a.href = '" . url("site/test/" . $view->id . "/" . $view->ad->id."/" . $web->id) . "';
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

    public function test($view_request_id,$ads_id,$website_id)
    {

       $ad= Ads::select('link')->find($ads_id);
    VisitedWebsite::updateOrCreate(['ip'=>getIP(),'view_request_id'=>$view_request_id,'ads_id'=>$ads_id],[
       'ip'=>getIP(),
       'browser'=>getBrowser(),
       'os'=>getOS(),
       'view_request_id'=>$view_request_id,
       'ads_id'=>$ads_id,
       'website_id'=>$website_id,
       'price'=>5,
       'type'=>'banner',
       'referrer_price'=>1,
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
                            'description' => "پرداخت کاربر - کد پیگیری  " . $Resnumber . "  درگاه",

                        ]
                    );
                    Payment::create(
                        [
                            'user_id' => $pay->user_id,
                            'payment_type' => 1,
                            'price' => -$Price,
                            'click_count' => $Price / 7,
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


    public function login(LoginRequest $request)
    {


        $message = 'نام کاربری یا رمز ورود اشتباه است';
        $authentication = false;
        $redirect = route('user.home');


        if (Auth::guard('user')->attempt(['email' => convert_to_digit($request->email, 'en'), 'password' => $request->password], $request->remember)) {
            // if successful, then redirect to their intended location
            $message = '';
            $authentication = true;
            $redirect = route('user.home');

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
        }
    }

    public function register(RegisterRequest $request)
    {
        sendMessageToBot($request['fname'] . " " . $request['lname'] . " ثبت نام کرد ", ['529275704', '288923947']);


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


            return ['authentication' => true, 'redirect' => route('user.home')];


        } catch (\Exception $exception) {

            return ['authentication' => false, 'redirect' => $exception->getMessage()];

        }
    }


    public function home()
    {

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


}
