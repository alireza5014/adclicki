<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Analyze;


use App\Http\Requests\AdsRequest;
use App\Model\Ads;
use App\Model\Payment;
use App\Model\ViewRequest;
use App\Model\VisitedLink;
use App\Model\Withdrawals;
use App\Setting;
use App\Ticket;
use App\TicketAnswer;

use App\User;
use Carbon\Carbon;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Mail;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class AdminController extends Controller
{
/// test
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function visit_chart()
    {
        $lastmonth = Carbon::now()->subDays(30);


        $result['visit'] = DB::select("SELECT created_at as y , COUNT(*) as a  FROM `visited_links` WHERE created_at > '{$lastmonth}'   GROUP by DATE_FORMAT(created_at, '%Y/%m/%d' )");
        $result['total_visit'] = VisitedLink::where('created_at', '>', $lastmonth)->count();


        return $result;
    }

    public function analyzes()
    {
        $os = Analyze::groupBy('os')->pluck('os');
        return view('admin.analyzes', compact('os'));
    }

    public function analyzes_summary($site)
    {
        $lastmonth = Carbon::now()->subDays(30);


        if ($site == 'all') {
            $result['receive_user'] = DB::select("SELECT created_at as y , COUNT(*) as a  FROM `analyzes` WHERE created_at > '{$lastmonth}'   GROUP by DATE_FORMAT(created_at, '%Y/%m/%d' )");
            $result['total_receive'] = Analyze::where('created_at', '>', $lastmonth)->count();

            $result['unique_ip_view'] = DB::select("SELECT created_at as y , COUNT(distinct (ip)) as a  FROM `analyzes` WHERE created_at > '{$lastmonth}'   GROUP by DATE_FORMAT(created_at, '%Y/%m/%d' )");
            $total_unique = Analyze::where('created_at', '>', $lastmonth)->select(DB::raw('count(distinct(ip)) as total_unique'))->first();
            $result['total_unique_ip_view'] = $total_unique['total_unique'];

        } else {

            $result['receive_user'] = DB::select("SELECT created_at as y , COUNT(*) as a  FROM `analyzes` WHERE created_at > '{$lastmonth}' && os='{$site}'  GROUP by DATE_FORMAT(created_at, '%Y/%m/%d' )");
            $result['total_receive'] = Analyze::where('created_at', '>', $lastmonth)->where('os', $site)->count();

            $result['unique_ip_view'] = DB::select("SELECT created_at as y , COUNT(distinct (ip)) as a  FROM `analyzes` WHERE created_at > '{$lastmonth}' && os='{$site}'  GROUP by DATE_FORMAT(created_at, '%Y/%m/%d' )");
            $total_unique = Analyze::where('created_at', '>', $lastmonth)->where('os', $site)->select(DB::raw('count(distinct(ip)) as total_unique'))->first();
            $result['total_unique_ip_view'] = $total_unique['total_unique'];

        }


        $total = Analyze::count();

        $result['total_user'] = User::count();
        $result['device'] = User::select(DB::raw('ROUND(count(id) *100/' . $result['total_user'] . ',1) as value'), 'device as  label')->groupBy('device')->get();

        $result['os'] = Analyze::select(DB::raw('ROUND(count(id) *100/' . $total . ',1) as value'), 'os as label')->groupBy('os')->get();
        $result['browser'] = Analyze::select(DB::raw('ROUND(count(id) *100/' . $total . ',1) as value'), 'browser as  label')->groupBy('browser')->get();

        $result['total'] = $total;
        return $result;
    }


    public function analyzes_keywords()
    {
        $keyword = Input::get('keyword', '');
        $date = Input::get('date', '');
        $keywords = Analyze::select('keyword', DB::raw('count(keyword) as keyword_count'))
            ->orderBy('keyword_count', 'DESC')
            ->groupBy('keyword')
            ->SearchKeyword($keyword, $date)
            ->paginate(20);

        return view('admin.keywords_list', compact('keywords'));
    }

    public function analyzes_links()
    {
        $keyword = Input::get('keyword', '');
        $date = Input::get('date', '');
        $links = Analyze::select('this_url', DB::raw('count(this_url) as visit_count'))
            ->orderBy('visit_count', 'DESC')
            ->groupBy('this_url')
            ->Search($keyword, $date)
            ->paginate(20);

        return view('admin.links_list', compact('links'));
    }


    public function getLogout()
    {


        Auth::guard('admin')->logout();

        return redirect()->guest(route('admin.login'));

//        Auth::logout('admin');
//
//        return back();

    }

    public function admin_modify_profile(Request $request)
    {
        $this->validate($request, [

            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $res = Admin::where('id', auth()->user()->id)->update([
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);


        if ($res > 0)
            return back()->with('success', " گذرواژه با موفقیت تغییر یافت ");
        else
            return back()->with('error', 'error');


    }

    public function admin_profile($id)
    {
        $user = Admin::find($id);
        return view('admin.profile', compact('user'));
    }


    public function index()
    {

        $data = [
            'همه کاربران' => User::count(),
            'کاربران عضو ربات' => User::where('chat_id', '>', 0)->count(),
            'کاربران با موبایل' => User::where('mobile', 'like', "09%")->count(),
            'کاربران فعال' => User::whereHas('visited_links', function ($query) {
                $query->where('created_at', '>', getToday());
            })->count(),
            'کاربران امروز' => User::where('created_at', '>', getToday())->count(),
            'کاربران دیروز' => User::where('created_at', '<', getToday())->where('created_at', '>', getYesterday())->count(),
            'همه آگهی ها' => Ads::count(),
            'آگهی های تایید شده' => Ads::where('status', 1)->count(),
            'آگهی ها فعال' => ViewRequest::where('status', 1)->count(),
            'آگهی ها امروز' => Ads::where('created_at', '>', getToday())->count(),
            'آگهی ها دیروز' => Ads::where('created_at', '<', getToday())->where('created_at', '>', getYesterday())->count(),
            'مجموع درآمد ها' => VisitedLink::sum('price'),
            'مجموع درآمد ها(کلیک)' => VisitedLink::where('type', 0)->sum('price'),
            'مجموع درآمد ها(جستجو گوگل)' => VisitedLink::where('type', 1)->sum('price'),
            'تعداد سایت های بازدید شده' => VisitedLink::count('price'),
            'درآمد  امروز کاربران' => VisitedLink::where('created_at', '>', getToday())->sum('price'),
            ' درآمد  دیروز کاربران' => VisitedLink::where('created_at', '<', getToday())->where('created_at', '>', getYesterday())->sum('price'),
            'مجموع  واریزی از سوی کاربران' => number_format(Payment::where('payment_type', 2)->sum('price')),
            'تعداد واریزی از سوی کاربران' => Payment::where('payment_type', 2)->count('price'),
            'واریز شده از سوی کاربران (امروز) ' => number_format(Payment::where('payment_type', 2)->where('created_at', '>', getToday())->sum('price')),
            '  واریز شده از سوی کاربران( دیروز) ' => number_format(Payment::where('payment_type', 2)->where('created_at', '<', getToday())->where('created_at', '>', getYesterday())->sum('price')),
            'مجموع  پرداخت شده به کاربران' => number_format(Payment::where('payment_type', 3)->sum('price')),
            'مجموع  پرداخت نشده به کاربران' => number_format(Withdrawals::where('is_pay', -1)->sum('price')),
            'تعداد پرداخت ها به کاربران' => Payment::where('payment_type', 3)->count('price'),
            'پرداخت شده به کاربران (امروز) ' => number_format(Payment::where('payment_type', 3)->where('created_at', '>', getToday())->sum('price')),
            '  پرداخت شده به کاربران( دیروز) ' => number_format(Payment::where('payment_type', 3)->where('created_at', '<', getToday())->where('created_at', '>', getYesterday())->sum('price')),
            'همه تیکت ها' => Ticket::count(),
            'تیکتهای بی پاسخ' => Ticket::where('status', 0)->count(),
            'IP های یکتا' => Analyze::distinct('ip')->count('ip'),

        ];

        return view('layouts.material.admin.home', compact('data'));
//        return view('email', compact('data'));
    }


    public function tickets($status)
    {

//        $email = "persian402@gmail.com";
//        $subject = "adclicki.ir";
//        $from = "mail@adclicki.ir";
//
//        $data = array(
//            'name' =>"ali",
//            'token' => "lkjlkh",
//            'email' => $email
//        );
//
//        Mail::send('email', compact('data'), function ($message) use ($email, $subject, $from) {
//            $message->to($email, '[ ADCLICKI ]')->subject($subject);
//            $message->from($from, '  بازیابی حساب کاربری ');
//        });


        $search = Input::get('search', '');

        $data[] = Ticket::where('status', 0)->count();
        $data[] = Ticket::where('status', 1)->count();
        $data[] = Ticket::where('status', 2)->count();
        $data[] = Ticket::where('status', 3)->count();
        $data[] = Ticket::count();

        $tickets = Ticket::with(['user' => function ($q) use ($search) {
            return $q->SearchByKeyword($search);
        }])->whereHas('user' , function ($q) use ($search) {
            return $q->SearchByKeyword($search);
        })
            ->GetTicket($status)
            ->orderBy('id', 'DESC')
            ->paginate(20);

        return view('layouts.material.admin.tickets.tickets', compact('tickets', 'data'));
    }


    public function show_ticket($id)
    {


        $this->seenTicket($id);

        $tickets = Ticket::with(['tickets_answers' => function ($q) {
            return $q->orderBy('id', 'ASC');
        }])
            ->with('user')->where('id', $id)->first();

        return view('layouts.material.admin.tickets.tickets_show', compact('tickets'));
    }

    private function updateTicket($id)
    {
        Ticket::where('id', $id)->update(['status' => 1, 'seen' => 1]);

    }

    private function seenTicket($id)
    {
        Ticket::where('id', $id)->update(['seen' => 1]);

    }

    public function save_ticket(Request $request, $id)
    {


        $this->validate($request, [
                'message' => 'required|max:10000'
            ]
        );

        $images = UPLOAD_IMAGE($request, 'image', 'images/tickets');
        $image_path = 'dd';
        if ($images) {
            $image_path = $images['image_path'][0];
        }
        $result = TicketAnswer::create([
            'message' => $request->message,
            'ticket_id' => $id,
            'sender_type' => 1,
            'ip' => getIP(),
            'image_path' => $image_path,
        ]);

        $this->updateTicket($id);


        $ticket = Ticket::where('id', $id)->select('user_id', 'subject')->first();
        $user = User::select('id', 'chat_id', 'fname', 'lname', 'email')->find($ticket->user_id);
        $text1 = "کاربر گرامی";
        $text1 .= "\n";
        $text1 .= $user->fname . " " . $user->lname;
        $text1 .= "\n";

        $text= " تیکت شما در تاریخ";
        $text .= "\n";
        $text .= Verta::now();
        $text .= "\n";

        $text .= "پاسخ داده شد.";
        $text .= "\n";
        $text .= "پاسخ تیکت شما :";
        $text .= "\n";

        $text .= $request->message;
        $text .= "\n";

        $text .= url('');


        if ($this->checkTicketNotification($user->id)) {
            sendMessageToBot($text1.$text, $user->chat_id);
            SEND_MESSAGE_WITH_MAIL($user->fname . " " . $user->lname, $user->email, $ticket->subject, $text);
        }


        if ($result)
            return redirect(route('admin.tickets', ['status' => 'all']))->with('success', 'پیام شما با موفقیت ارسال شد. ');

        else
            return redirect(route('admin.tickets', ['status' => 'all']))->with('error', ' خطا در ارسال پیام . مجدد تلاش کنید');


    }

    private function checkTicketNotification($user_id)
    {
        return (getUserNotification($user_id)['ticket'] == 1) ? true : false;
    }
}
