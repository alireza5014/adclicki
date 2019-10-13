<?php


use App\Model\Ads;
use App\Model\Payment;
use App\Model\Subcategory;
use App\Model\VisitedLink;
use App\Model\VisitedWebsite;
use App\Setting;
use App\Ticket;
use App\User;
use Carbon\Carbon;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

use Intervention\Image\ImageManagerStatic as Image;
use Telegram\Bot\Api;
use Telegram\Bot\Exceptions\TelegramSDKException;

function getAlexaRank($url)
{





    $ranks = Cache::remember($url, 60 * 60 * 24, function () use ($url) {

        try{
            $string = file_get_contents("https://www.alexa.com/siteinfo/" . $url);

        }
        catch (Exception $e){
            $string='';
        }
        $global = substr($string, strpos($string, 'rankmini-rank'), 100);
        $iran = substr($string, strpos($string, '🇮🇷 Iran'), 100);
        $iran = (int)filter_var($iran, FILTER_SANITIZE_NUMBER_INT);
        $global = (int)filter_var($global, FILTER_SANITIZE_NUMBER_INT);
        return ["iran" => abs($iran), "global" => abs($global)];


    });


    return $ranks;

}
function admin_bot_id(){
 return   ['618723858', '599050835', '288923947'];
}
function website_status($status)
{
    switch ($status) {
        case 0:
            echo '<span class="btn btn-warning btn-xs">درحال بررسی  </span>';

            break;

        case 1:
            echo '<span class="btn btn-success btn-xs"> تایید شده و فعال  </span>';

            break;

        case 2:
            echo '<span class="btn btn-danger btn-xs"> رد شده  </span>';

            break;
    }


}

function getActivityType()
{
    (auth('user')->check()) ? $activity_type = auth('user')->user()->activity_type : $activity_type = 2;
    return $activity_type;
}

function sendMessageToBot($text, $chat_id)
{
    try {
//        $telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
        $telegram = new Api('640316721:AAE_C1Ge-Pi9npRlQEi5k1IgPj2Jsp16KlM');

        if (gettype($chat_id) != 'array') {
            $chat_id = [$chat_id];
        }

        for ($i = 0; $i < sizeof($chat_id); $i++) {
            try {
                $telegram->sendMessage([
                    'chat_id' => $chat_id[$i],
                    'text' => $text
                ]);
            } catch (Exception $exception) {

            }
        }


    } catch (TelegramSDKException $e) {

    }


}

 function getHirePrice(){
return 700;
     return getTodayUnClickedLinkCount(0)*30+getTodayUnClickedLinkCount(1)*2*30;
 }
function getTodayUnClickedLinkCount($type = 0)
{
    $visited_link = VisitedLink::where('created_at', '>', getNow()->subHour(2))
        ->where('price', '>', 0)
        ->pluck('view_request_id');

    $ads_count = Ads::whereHas('view_request', function ($q) use ($visited_link) {
        $q->where('status', 1)
            ->where('count', '>', 0)
            ->whereNotIn('id', $visited_link);
    })
        ->where('status', 1)
        ->where('type', $type)
        ->count();

    return $ads_count;
}


function getTodayUnClickedLink($user_id, $type = 0)
{
    $visited_link = VisitedLink::where('visited_id', $user_id)
        ->where('created_at', '>', getNow()->subHour(2))
        ->where('price', '>', 0)
        ->pluck('view_request_id');

    $ads_count = Ads::whereHas('view_request', function ($q) use ($visited_link) {
          $q->where('status', 1)
            ->where('count', '>', 0)
            ->whereNotIn('id', $visited_link);
    })
        ->where('status', 1)
        ->where('type', $type)
        ->count();

    return $ads_count;
}

function getUserNotification($user_id = 0)

{

    if (auth('user')->check()) {
        $user_id = getUserId();
    }

    return \App\Model\Notification::where('user_id', $user_id)->first();
}

function getUnConfirmClickiAds()
{
    return \App\Model\Ads::where('status', -1)->where('type', 0)->count();
}

function getUnConfirmGoogleSearchAds()
{
    return \App\Model\Ads::where('status', -1)->where('type', 1)->count();
}

function getUserPayment()
{
    return \App\Model\Payment::where('payment_type', 2)->count();
}

function getUnPayedWithdraw()
{
    return \App\Model\Withdrawals::where('is_pay', -1)->count();
}

function getSetting($field = 'all')
{
    if ($field == 'all')
        $setting = Setting::first();
    else
        $setting = Setting::select($field)->first();


    return $setting;

}

function getTotalBalance($user_id)
{

    return Payment::where('user_id', $user_id)->sum('price') + getTotalIncome($user_id) + getRefererIncome($user_id)+getTotalWebsite('all',$user_id)+getSubCategoryIncome($user_id);

}

function getTodayIncome($user_id)
{
    return VisitedLink::where('visited_id', $user_id)->where('created_at', '>', getToday())->sum('price');

}


function getTotalIncome($user_id,$date='total')
{

    $res= VisitedLink::where('visited_id', $user_id);

    if($date!='total'){
        $res->where('created_at','>',getToday());
    }
   return $res->sum('price');

}

function getIncome($user_id, $type = 'total')
{


    return VisitedLink::where('visited_id', $user_id)->where('type', $type)->sum('price');

}

function getReferercount($user_id)
{
    return User::where('referer_id', $user_id)->count();

}

function getSubcategoryCount($user_id)
{
    return Subcategory::where('user_id', $user_id)->count();

}

function getRefererIncome($user_id)
{


    $referer = User::where('referer_id', $user_id)->pluck('id');
    return VisitedLink::whereIn('visited_id', $referer)->sum('referer_price');

}
function getSubCategoryIncome($user_id)
{

    $income=0;
    $referers =  Subcategory::where('user_id', $user_id)->get(['referrer_id','expire_date','created_at']);

    for ($i=0;$i<sizeof($referers);$i++)
    {
        $income+=VisitedLink::where('visited_id', $referers[$i]['referrer_id'])
            ->where('created_at','>=',$referers[$i]['created_at'])
            ->where('created_at','<=',$referers[$i]['expire_date'])
            ->sum('referer_price');
    }
    return $income;

}



function getTotalClick()
{
    return Payment::where('user_id', getUserId())->sum('click_count');

}

function getTotalWebsite($type = 'all',$user_id=0)
{
    if($user_id==0){
        $user_id=getUserId();
    }

      $res= VisitedWebsite::whereHas('website',function ($q) use ($user_id){
         $q->where('user_id', $user_id);
     });
         if($type!='all'){
             $res->where('type', $type);

         }

    return $res->sum('price');

}

function getTotalSearch()
{
    return Payment::where('user_id', getUserId())->sum('click_count') / 5;

}


function getTotalDaryafti()
{

    return Payment::where('user_id', getUserId())->where('payment_type', 3)->sum('price') * -1;

}

function getUserIdAfterChecking($guard='user')
{
    if (auth($guard)->check())
        return auth($guard)->user()->id;
    else
        return getUnknownUserId();
}

function getUserId($guard = 'user')
{
    return auth($guard)->user()->id;
}


function getUserActivityType($guard = 'user')
{
    return auth($guard)->user()->activity_type;
}

function getAdminUserId()
{
    return 1;
}

function getUnknownUserId()
{
    return 1000000;
}

function getToday()
{


    return Carbon::today();
}

function getNow()
{


    return Carbon::now();
}

function getYesterday()
{


    return Carbon::yesterday();
}

function change_social($name)
{
    $social = [
        'telegram' => 'تلگرام',
        'twitter' => 'تویتر',
        'instagram' => 'اینستاگرام',
        'whatsapp' => 'واتس آپ',
        'email' => 'ایمیل',
        'website' => 'وبسایت'
    ];

    return $social[$name];
}

function getSocials()
{
    return ['telegram', 'twitter', 'instagram', 'whatsapp', 'email', 'website'];

}

function encodeImageToBase64($image_path)
{

    try {
        $type = pathinfo($image_path, PATHINFO_EXTENSION);
        $data = file_get_contents($image_path);
        return 'data:image/' . $type . ';base64,' . base64_encode($data);
    } catch (Exception $exception) {

    }

}

function getRateType($index)
{
    $rate = [
        'کیفیت خدمات',
        'سرعت پاسخ دهی',
        'نحوه برخورد',
        'تناسب قیمت و خدمات',


    ];

    return $rate[$index - 1];

}

function persian_days()
{
    return [
        'شنبه',
        'یک شنبه',
        'دوشنبه',
        'سه شنبه',
        'چهارشنبه',
        'پنج شنبه',
        'جمعه',

    ];
}

function english_days()
{
    return [
        'Saturday',
        'Sunday',
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',

    ];
}

function persianDayOfWeek($day)
{


    $index = array_search($day, english_days());
    return persian_days()[$index];

}


function getLastWord($url)
{
    return substr($url, strrpos($url, '/') + 1);
}

function getUnAnsweredTicket()
{
    return Ticket::where('status', 0)->count();


}


function getTicketType($type)
{

    $color = ['danger', 'success', 'info', 'warning'];
    $text = ['پاسخ مشتری', 'پاسخ داده شده', 'باز', 'بسته شده'];
    echo '<span class="btn btn-' . $color[$type] . ' btn-xs">' . $text[$type] . '  </span>';

}

function getTicketSeen($seen)
{
    if (!$seen)
        echo '<i class="zmdi zmdi-eye-slash btn-danger btn btn-sm "></i>';
    else
        echo '<i class="zmdi zmdi-eye btn-success btn btn-sm "></i>';
}

function active($status)
{
    if ($status == 1)

        echo '<span class="btn btn-success btn-xs">فعال  </span>';
    else
        echo '<span class="btn btn-danger btn-xs">غیر فعال  </span>';
}


function complete($status)
{
    if ($status == 1)

        echo '<span class="btn btn-success btn-xs">کامل  </span>';
    else
        echo '<span class="btn btn-danger btn-xs">  ناقص  </span>';
}

function user_type($type)
{
    switch ($type) {
        case 0 :
            echo '<span title="با فعالیت در سایت ادکلیکی حساب کاربری شما ارتقاء خواهد یافت" class="btn btn-success btn-xs">    کاربر برنزی      </span>';

            break;

        case 1 :
            echo '<span class="btn btn-warning btn-xs"> نقره ای      </span>';

            break;
    }

}

function confirm($publish)
{
    if ($publish == 1)
        echo '<span class="btn btn-success btn-xs">     تایید شده      </span>';
    else
        echo '<span class="btn btn-warning btn-xs">  درحال بررسی توسط کارشناس       </span>';
}

function is_payed($status)
{
    if ($status == 1)

        echo '<span class="btn btn-success btn-xs">پرداخت شده  </span>';
    else
        echo '<span class="btn btn-danger btn-xs">  پرداخت نشده  </span>';
}

function engine_type($type)
{
    if ($type == 1)

        echo '<span class="btn btn-success btn-xs">   جستجوی گوگل  </span>';
    else
        echo '<span class="btn btn-danger btn-xs">     جستجوی بینگ  </span>';
}

function getOM($x)
{
    switch ($x) {
        case 1:

            return "y";
            break;

        case 2:

            return "دوم";
            break;

        case 3:

            return "سوم";
            break;
    }
}

function convert_to_digit($string, $to_langoage = 'farsi')
{
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];

    $num = range(0, 9);
    if ($to_langoage == 'farsi')
        return $convertedPersianNums = str_replace($num, $persian, $string);
    else

        return $englishNumbersOnly = str_replace($persian, $num, $string);

}

function getPay($i)
{
    if ($i == 1)
        return "<span class='btn btn-danger btn-xs' >پرداخت نشده</span>";

    else
        return "<span class='btn btn-success btn-xs' >پرداخت شده</span>";


}

function UPLOAD_IMAGE($request, $target, $store_path = 'images', $watermark_path = '', $resizePercentage = 80, $position = 'bottom-left', $resize_percent = 0, $quality = 100)
{

    $i = 0;

    if ($request->hasFile($target)) {
        if (gettype($request->file($target)) == 'object') {
            $images[] = $request->file($target);
        } else {
            $images = $request->file($target);
        }

        foreach ($images as $image) {


            //  $image = $request->file($target);
            $name = $image->getClientOriginalName();
            $rand = str_random(10) . "_";
            $image->move(public_path() . '/' . $store_path . '/', $rand . $name);
            $result['image_path'][$i] = $store_path . '/' . $rand . $name;

            $result['watermark_path'][$i] = '';
            if ($watermark_path != '') {
                $img1 = $img = Image::make(public_path($result['image_path'][$i]));


                $watermark = Image::make(public_path($watermark_path));
//                $watermarkSize = $img->width() - 200; //size of the image minus 20 margins
//                $watermarkSize = $img->width() / 2; //half of the image size
                $watermarkSize = round($img->width() * ((100 - $resizePercentage) / 100), 2); //watermark will be $resizePercentage less then the actual width of the image
                $watermark->resize($watermarkSize, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->insert($watermark, $position);


                $img->save(public_path() . '/' . $store_path . '/' . $rand . '_watermark_' . $name, $quality);
                $result['watermark_path'][$i] = $store_path . '/' . $rand . '_watermark_' . $name;


                $width = $img1->getWidth() - $img1->getWidth() * $resize_percent / 100;
                $height = $img1->getHeight() - $img1->getHeight() * $resize_percent / 100;
                $img1->resize($width, $height);
                $img1->save(public_path() . '/' . $store_path . '/' . $rand . '_resize_' . $name);
                $result['resize_path'][$i] = $store_path . '/' . $rand . '_resize_' . $name;
            }

            $i++;

        }
        return $result;

    }

    return false;
}

function makeAnalyze()
{

    // $from_url = @$_SERVER['HTTP_REFERER'];
    $from_url = request()->headers->get('referer');

    // $from_url="https://www.google.com/search?num=100&rlz=1C5CHFA_enIR810IR810&biw=1280&bih=690&ei=Gfy5W5y5FcOzwATUiLgY&q=%D8%A2%DB%8C%D8%A7+%D9%85%D9%86%D8%B8%D9%88%D8%B1+%D8%B4%D9%85%D8%A7+%D8%A7%DB%8C%D9%86+&oq=%D8%A2%DB%8C%D8%A7+%D9%85%D9%86%D8%B8%D9%88%D8%B1+%D8%B4%D9%85%D8%A7+%D8%A7%DB%8C%D9%86+&gs_l=psy-ab.3...150380.150380.0.150771.0.0.0.0.0.0.0.0..0.0....0...1c.1.64.psy-ab..0.0.0....0.jI1mJCuozAY";
    // var_dump($from_url);
//    $from_url = "https://www.google.com/search?num=100&rlz=1C5CHFA_enIR810IR810&ei=EF0wXMTnCoebsAf61Z_ICQ&q=js+referer++variable&oq=js+referer++variable&gs_l=psy-ab.3...90534.92349..93766...0.0..0.175.1316.0j8......0....1..gws-wiz.......0i7i30j0i8i7i30.uIinycYMNLk";
    $keyword = getKeyword($from_url);

    $this_url = urldecode($_SERVER['REQUEST_URI']);
    $domain = urldecode($_SERVER['SERVER_NAME']);
    $now = Carbon::now();
    DB::table('analyzes')->insert(
        [
            'from_url' => $from_url,
            'this_url' => $this_url,
            'ip' => getIP(),
            'os' => getOS(),
            'browser' => getBrowser(),
            'domain' => $domain,
            'keyword' => $keyword,
            'created_at' => $now,
        ]
    );


}

function getOS()
{
    $user_agent = $_SERVER['HTTP_USER_AGENT'];


    $os_platform = "Unknown OS Platform";

    $os_array = array(
        '/windows nt 10/i' => 'Windows 10',
        '/windows nt 6.3/i' => 'Windows 8.1',
        '/windows nt 6.2/i' => 'Windows 8',
        '/windows nt 6.1/i' => 'Windows 7',
        '/windows nt 6.0/i' => 'Windows Vista',
        '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
        '/windows nt 5.1/i' => 'Windows XP',
        '/windows xp/i' => 'Windows XP',
        '/windows nt 5.0/i' => 'Windows 2000',
        '/windows me/i' => 'Windows ME',
        '/win98/i' => 'Windows 98',
        '/win95/i' => 'Windows 95',
        '/win16/i' => 'Windows 3.11',
        '/macintosh|mac os x/i' => 'Mac OS X',
        '/mac_powerpc/i' => 'Mac OS 9',
        '/linux/i' => 'Linux',
        '/ubuntu/i' => 'Ubuntu',
        '/iphone/i' => 'iPhone',
        '/ipod/i' => 'iPod',
        '/ipad/i' => 'iPad',
        '/android/i' => 'Android',
        '/blackberry/i' => 'BlackBerry',
        '/webos/i' => 'Mobile'
    );

    foreach ($os_array as $regex => $value) {

        if (preg_match($regex, $user_agent)) {
            $os_platform = $value;
        }

    }

    return $os_platform;

}

function getBrowser()
{
    $user_agent = $_SERVER['HTTP_USER_AGENT'];


    $browser = "Unknown Browser";

    $browser_array = array(
        '/msie/i' => 'Internet Explorer',
        '/firefox/i' => 'Firefox',
        '/safari/i' => 'Safari',
        '/chrome/i' => 'Chrome',
        '/edge/i' => 'Edge',
        '/opera/i' => 'Opera',
        '/netscape/i' => 'Netscape',
        '/maxthon/i' => 'Maxthon',
        '/konqueror/i' => 'Konqueror',
        '/mobile/i' => 'Handheld Browser'
    );

    foreach ($browser_array as $regex => $value) {

        if (preg_match($regex, $user_agent)) {
            $browser = $value;
        }

    }

    return $browser;

}

function getKeyword($url)
{
    $url = urldecode($url);
    $variable = substr($url, 0, strpos($url, "&oq="));
    $whatIWant = substr($variable, strpos($variable, "&q=") + 3);
    return str_replace('+', ' ', $whatIWant);
}

function KKK()
{

    $from_url = @$_SERVER[HTTP_REFERER];

    // $from_url="https://www.google.com/search?num=100&rlz=1C5CHFA_enIR810IR810&biw=1280&bih=690&ei=Gfy5W5y5FcOzwATUiLgY&q=%D8%A2%DB%8C%D8%A7+%D9%85%D9%86%D8%B8%D9%88%D8%B1+%D8%B4%D9%85%D8%A7+%D8%A7%DB%8C%D9%86+&oq=%D8%A2%DB%8C%D8%A7+%D9%85%D9%86%D8%B8%D9%88%D8%B1+%D8%B4%D9%85%D8%A7+%D8%A7%DB%8C%D9%86+&gs_l=psy-ab.3...150380.150380.0.150771.0.0.0.0.0.0.0.0..0.0....0...1c.1.64.psy-ab..0.0.0....0.jI1mJCuozAY";

    $keyword = getKeyword($from_url);

    $this_url = $_SERVER['REQUEST_URI'];
    $domain = $_SERVER['SERVER_NAME'];
    $now = Carbon::now();
    DB::table('analyzes')->insert(
        [
            'from_url' => $from_url,
            'this_url' => $this_url,
            'ip' => getIP(),
            'os' => getOS(),
            'browser' => getBrowser(),
            'domain' => $domain,
            'keyword' => $keyword,
            'created_at' => $now,
        ]
    );
}

function getIP()
{

    $tmp = getenv("HTTP_CLIENT_IP");

    if ($tmp && !strcasecmp($tmp, "unknown"))
        return $tmp;

    $tmp = getenv("HTTP_X_FORWARDED_FOR");
    if ($tmp && !strcasecmp($tmp, "unknown"))
        return $tmp;


    $tmp = getenv("REMOTE_ADDR");
    return $tmp;


}


function CheckHasRedis($key)
{
    if (Redis::exists($key)) {
        $response = json_decode(Redis::get($key), true);

        return $response;
    }

}

function enToAr($string)
{
    return strtr($string, array('0' => '٠', '1' => '١', '2' => '٢', '3' => '٣', '4' => '٤', '5' => '٥', '6' => '٦', '7' => '٧', '8' => '٨', '9' => '٩'));
}

function is_public($is_public)
{
    if ($is_public == 1)

        echo 'عمومی';
    else
        echo 'خصوصی';
}

function LastSeen($request)
{
    $user = JWTAuth::toUser(str_replace('Bearer ', '', $request->headers->get('Authorization')));
    $value = Carbon::now();
    User::where('id', '=', $user->id)->update(['last_seen' => $value]);

    //Redis::set('last_seen_'.$user->id,$value);

// echo \Redis::get('last_seen_'.$user->id);
    // echo $user->id;

}

function flash($title = null, $message = null)
{

    $flash = app('App\Http\Flash');
    if (func_num_args() == 0) {
        return $flash;
    }
    return $flash->info($title, $message);
}

function SEND_RECOVERY_MAIL($to_name,$to_email,$recovery_link){

    $data = array(
        "link" => $recovery_link,
        "name" =>$to_name,
    );

    Mail::send('mails.recover_password', $data, function ($message) use ($to_name, $to_email) {
        $message->to($to_email, $to_name)
            ->subject('فراموشی رمز عبور ');
        $message->from('adclicki.ir@gmail.com', '[ADCLICKI.IR]');
    });
}

function SEND_MESSAGE_WITH_MAIL($to_name,$to_email,$title,$description){

    $data = array(
        "name" => $to_name,
        "title" => $title,
        "description" =>$description,
    );

  try{  Mail::send('mails.message', $data, function ($message) use ($to_name, $to_email,$title) {
      $message->to($to_email, $to_name)
          ->subject($title);
      $message->from('adclicki.ir@gmail.com', '[ADCLICKI.IR]');
  });
  }
  catch (Exception $e){
      file_put_contents("error.txt",$e->getMessage());

  }
}


function SEND_SMS($mobile, $message)
{
    // require __DIR__ . '/vendor/autoload.php';

    require __DIR__ . '/../vendor/autoload.php';

    try {
        $api = new \Kavenegar\KavenegarApi("467A4C444D706362632F317451375756696F36635475674835303649784A6162");
        $sender = "10004346";

        $receptor = array($mobile);
        $result = $api->Send($sender, $receptor, $message);
        return $result;
//        if($result){
//            foreach($result as $r){
//                echo "messageid = $r->messageid";
//                echo "message = $r->message";
//                echo "status = $r->status";
//                echo "statustext = $r->statustext";
//                echo "sender = $r->sender";
//                echo "receptor = $r->receptor";
//                echo "date = $r->date";
//                echo "cost = $r->cost";
//            }
//        }
    } catch (\Kavenegar\Exceptions\ApiException $e) {
        // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
        $e->errorMessage();
    } catch (\Kavenegar\Exceptions\HttpException $e) {
        // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
        $e->errorMessage();
    }
}


//function sendInstagramPost($image,$caption){
//
////    require __DIR__ . '/../public/instagram_upload.php';
//
//
//
////    include_once("instagram-photo-video-upload-api.class.php");
////Upload::create('instagram')
////    ->Login("pininja.ir", "Pp5014397")
////    ->UploadPhoto("square-image.jpg", "Test Upload Photo From PHP");
//// Upload Photo
////    $obj = new \App\classes\Instagram();
////    $obj->Login("pininja.ir", "Pp5014397");
////    $obj->UploadPhoto("square-image.jpg", "Test Upload Photo From PHP");
//
//// Upload Video
////    $obj = new InstagramUpload();
////    $obj->Login("pininja.ir", "Pp5014397");
////
////    $obj->UploadVideo("test-video.mp4", "square-thumb.jpg", "Test Upload Video From PHP");
//
//
//}


function sendTextMessage($mobile, $message)
{

    //turn off the WSDL cache
    ini_set("soap.wsdl_cache_enabled", "0");
    $sms_client = new SoapClient('http://webservice.0098sms.com/service.asmx?wsdl', array('encoding' => 'UTF-8'));
    $parameters['username'] = "smsq4993";
    $parameters['password'] = "pp5014397";
    $parameters['mobileno'] = $mobile;
    $parameters['pnlno'] = "30005367";
    $parameters['text'] = $message;
    $parameters['isflash'] = false;
    $sms_client->SendSMS($parameters)->SendSMSResult;

}

function sendTextMessage1($mobile, $message)
{
    $sms_username = 'peyk.shahr';
    $sms_password = '065ALI1811457s$';
    $from_number = array('30005088773504');

    $to_number = array('09126145705');
    $message = array('123422');
    $client = new SoapClient("http://parsasms.com/webservice/v2.asmx?WSDL");

    $params = array(
        'username' => $sms_username,
        'password' => $sms_password,
        'senderNumbers' => $from_number,
        'recipientNumbers' => $to_number,
        //'sendDate'=> $sendDate,
        'messageBodies' => $message
    );

    $results = $client->SendSMS($params);


    //   return $results;
}

function app_response($status, $message, $error = ['b' => ''], $data = ['a' => ''])

{

    return response()->json(['status' => $status, 'message' => $message, 'error' => $error, 'data' => $data]);
}


function remove_element(&$array, $value)
{
    if (($key = array_search($value, $array)) !== false) {
        unset($array[$key]);
    }
}


function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE)
{
    $output = NULL;
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }
    $purpose = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
    $support = array("country", "countrycode", "state", "region", "city", "location", "address");
    $continents = array(
        "IR" => "Iran",
        "AN" => "Antarctica",
        "AS" => "Asia",
        "EU" => "Europe",
        "OC" => "Australia (Oceania)",
        "NA" => "North America",
        "SA" => "South America"
    );
    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
            switch ($purpose) {
                case "location":
                    $output = array(
                        "city" => @$ipdat->geoplugin_city,
                        "state" => @$ipdat->geoplugin_regionName,
                        "country" => @$ipdat->geoplugin_countryName,
                        "country_code" => @$ipdat->geoplugin_countryCode,
                        "continent" => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                        "continent_code" => @$ipdat->geoplugin_continentCode
                    );
                    break;
                case "address":
                    $address = array($ipdat->geoplugin_countryName);
                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
                        $address[] = $ipdat->geoplugin_regionName;
                    if (@strlen($ipdat->geoplugin_city) >= 1)
                        $address[] = $ipdat->geoplugin_city;
                    $output = implode(", ", array_reverse($address));
                    break;
                case "city":
                    $output = @$ipdat->geoplugin_city;
                    break;
                case "state":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "region":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "country":
                    $output = @$ipdat->geoplugin_countryName;
                    break;
                case "countrycode":
                    $output = @$ipdat->geoplugin_countryCode;
                    break;
            }
        }
    }
    return $output;
}
