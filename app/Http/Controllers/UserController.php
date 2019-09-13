<?php

namespace App\Http\Controllers;


use App\Http\Requests\BankInfoRequest;
use App\Http\Requests\UserProfileRequest;

use App\Model\Ads;
use App\Model\VisitedLink;
use App\Setting;
use App\Ticket;
use App\TicketAnswer;
use App\User;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Mockery\Exception;

class UserController extends Controller
{


    public function salary()
    {
//        $user_id = Input::get('user_id', '');

        $salary = VisitedLink::where('visited_id', getUserId())->select('id','visited_id', DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as created_at "), DB::raw('sum(price) as price'), DB::raw('count(price) as click_count'))
            ->groupBy(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')")
            )
            ->with(['v_user' => function ($q) {
                return $q->select('id','fname','lname','email','mobile','image_path','created_at');
            }])

            ->orderBy('id','DESC')
            ->paginate(15);



        return view('layouts.material.user.salary_list', compact('salary'));
    }

    private function confirm_search($user_id, $type, $engine)
    {
        $from_url = rtrim(request()->headers->get('referer'), '/');
//        $from_url=   $_SERVER['HTTP_REFERER'];
        $url1 = parse_url($from_url);

        $from_url = $url1['scheme'] . "://" . $url1['host'];
        // type 1= google
        // type 2 = bing

        try {
            $ads = Ads::
            where('link', "LIKE", "%$from_url%")
                ->where('user_id', $user_id)
                ->where('type', $type)
                ->where('status', 1)
                ->with(['view_request' => function ($q) {
                    return $q->select('id', 'ads_id', 'count', 'status');
                }])
                ->withCount(['visited_links' => function ($q) {
                    return $q->where('visited_id', getUserId())
                        ->where('created_at', '>', getNow()->subHour(2));
                }])
                ->get();
//            file_put_contents("google_test2.txt",$ads."__");

            $x = 0;
            for ($i = 0; $i < sizeof($ads); $i++) {
                if ($ads[$i]->visited_links_count == 0) {
                    $x = $i;
                }
            }
            if (isset($ads[$x]->visited_links_count)) {
                if ($ads[$x]->visited_links_count == 0) {
                    $setting = getSetting();
                    $res = VisitedLink::create(

                        [
                            'visited_id' => getUserId(),
                            'view_request_id' => $ads[$x]->view_request->id,
                            'ads_id' => $ads[$x]->id,
                            'type' => $type,
                            'price' => 10,
                            'referer_price' => 10 * $setting['referer_percent'] / 100,
                            'ip' => getIP(),
                            'os' => getOS(),
                            'browser' => getBrowser(),

                        ]
                    );
                    return redirect(route('user.ads.search_list', ['engine' => $engine]))->with('success', 'شما 10 تومان درآمد این تبلیغ را دریافت کردید');

                } else {
                    return redirect(route('user.ads.search_list', ['engine' => $engine]))->with('error', 'شما قبلا درآمد این آگهی را دریافت کرده اید');
                }
            } else {
                return redirect(route('user.ads.search_list', ['engine' => $engine]))->with('error', 'خطای ۱۲۳۴۵');

            }


        } catch (Exception $exception) {

        }

    }

    public function pkg($user_id, $type)
    {
        switch ($type) {
            case 'google':
                return $this->confirm_search($user_id, 1, 'google');
                break;
            case 'bing':
                return $this->confirm_search($user_id, 2, 'bing');
                break;
            case 'aparat':
                return $this->confirm_search($user_id, 3, 'aparat');
                break;
            case 'yahoo':
                return $this->confirm_search($user_id, 4, 'yahoo');
                break;
        }

    }


    public function profile()
    {
        try {
            $user = User::find(getUserId());
            return view('layouts.material.user.profile', compact('user'));
        } catch (Exception $exception) {

        }
    }

    public function modify_profile(UserProfileRequest $request)
    {

        try {


            User::where('id', getUserId())->update(
                [
                    'fname' => $request->fname,
                    'lname' => $request->lname,
                    'code_melli' => $request->code_melli,
                    'mobile' => $request->mobile,
                    'activity_type' => $request->activity_type,
                ]
            );
        } catch (Exception $exception) {

        }

        return back()->with('success', 'اطلاعات شما با موفقیت ویرایش شد');

    }

    public function password()
    {
        return view('layouts.material.user.password');

    }

    public function change_password(Request $request)
    {
        $this->validate($request, [

            'password' => 'required|string|min:6|confirmed',
        ]);

        $res = User::where('id', getUserId())->update([

            'password' => bcrypt($request->password),
        ]);


        if ($res > 0)
            return back()->with('success', " گذرواژه با موفقیت تغییر یافت ");
        else
            return back()->with('error', 'error');


    }

    public function edit_bank_info()
    {
        try {
            $user = User::find(getUserId());
            return view('layouts.material.user.bank_info', compact('user'));
        } catch (Exception $exception) {

        }
    }

    public function modify_bank_info(BankInfoRequest $request)
    {
        try {


            User::where('id', getUserId())->update(
                [
                    'card_number' => $request->card_number,
                    'shaba_number' => $request->shaba_number,

                ]
            );
        } catch (Exception $exception) {

        }

        return back()->with('success', 'اطلاعات شما با موفقیت ویرایش شد');
    }


    private function updateTicket($id)
    {
        Ticket::where('id', $id)->update(['status' => 0, 'seen' => 1]);

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
            'sender_type' => 0,
            'ip' => getIP(),
            'image_path' => $image_path,
        ]);

        $this->updateTicket($id);


        $text = "کاربر گرامی";
        $text .= "\n";

        $text .= " پاسخ شما در تاریخ";
        $text .= "\n";
        $text .= Verta::now();
        $text .= "\n";
        $text .= "ip: " . getIP();
        $text .= "\n";
        $text .= "os: " . getOS();
        $text .= "\n";
        $text .= "browser: " . getBrowser();
        $text .= "\n";
        $text .= "با موفقیت ارسال شد.";
        $text .= "\n";
        $text .= "منتظر پاسخ پشتیبان باشید";
        $text .= url('');


        sendMessageToBot($request->message, ['618723858', '599050835', '288923947']);
        if ($this->checkTicketNotification()) {
            sendMessageToBot($text, auth('user')->user()->chat_id);
        }


        if ($result)
            return back()->with('success', 'پیام شما با موفقیت ارسال شد. منتظر پاسخ کارشناس بمانید.');

        else
            return back()->with('error', ' خطا در ارسال پیام . مجدد تلاش کنید');


    }


    public function getLogout()
    {
        Auth::guard('user')->logout();
        return redirect()->guest(route('site_home'));
    }

    public function tickets()
    {
        $tickets = Ticket::where('user_id', getUserId('user'))->orderBy('id', 'desc')->paginate(20);

        return view('layouts.material.user.ticket.tickets', compact('tickets'));
    }


    public function ticketsList()
    {

        $keyword = Input::get('keyword', '');


        $tickets = Ticket::where('user_id', auth()->user()->id);

        return view('user.tickets', compact('tickets'));
    }

    private function seenTicket($id)
    {
        Ticket::where('id', $id)->update(['seen' => 1]);

    }

    public function show_ticket($id)
    {
        $this->seenTicket($id);

        $tickets = Ticket::with(['tickets_answers' => function ($q) {
            return $q->orderBy('id', 'ASC');
        }])
            ->with('user')->where('id', $id)->first();
        return view('layouts.material.user.ticket.tickets_show', compact('tickets'));
    }

    public function newTicket(Request $request)
    {


        $this->validate($request, [
            'message' => 'required',
            'subject' => 'required|max:80',
        ]);
        $images = UPLOAD_IMAGE($request, 'image', 'images/tickets');
        $image_path = 'dd';
        if ($images) {
            $image_path = $images['image_path'][0];
        }


        $result = Ticket::create([
            'message' => $request->message,
            'user_id' => auth()->user()->id,
            'ip' => getIP(),
            'subject' => $request->subject,
            'image_path' => $image_path,
            'status' => 0
        ]);


        $text = "کاربر گرامی";
        $text .= "\n";

        $text .= " تیکت شما در تاریخ";
        $text .= "\n";
        $text .= Verta::now();
        $text .= "\n";
        $text .= "ip: " . getIP();
        $text .= "\n";
        $text .= "os: " . getOS();
        $text .= "\n";
        $text .= "browser: " . getBrowser();
        $text .= "\n";
        $text .= "با موفقیت ثبت شد.";
        $text .= "\n";
        $text .= "منتظر پاسخ پشتیبان باشید";
        $text .= url('');


        sendMessageToBot($request->message, ['618723858', '599050835', '288923947']);
        if ($this->checkTicketNotification()) {
            sendMessageToBot($text, auth('user')->user()->chat_id);
        }


        if ($result)
            return back()->with('success', 'تیکت شما ثبت شد منتظر پاسخ پشتیبان باشید');
        else
            return back()->with('error', 'error');


    }

    private function checkTicketNotification()
    {
        return (getUserNotification()['ticket'] == 1) ? true : false;
    }

    public function referer_list()
    {

        $referer_percent = getSetting('referer_percent')['referer_percent'];


        $referer = User::where('referer_id', getUserId())
            ->select('id', 'fname', 'lname', 'image_path', 'created_at', 'email', 'country')
            ->withCount('r_visited_price')
            ->withCount('r_visited_referer_price')
            ->orderBy('id', 'DESC')
            ->get();


        return view('layouts.material.user.referer.list', compact('referer', 'referer_percent'));

    }


    public function learning()
    {
        return view('layouts.material.user.learning');
    }


}
