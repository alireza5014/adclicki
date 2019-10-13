<?php

namespace App\Http\Controllers\Admin;

use App\classes\UpLoad;
use App\Model\Message;
use App\Model\VisitedLink;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Mockery\Exception;
use SoapClient;

class UserController extends Controller
{



    public function salary()
    {

        $user_id = Input::get('user_id', '');

        $salary = VisitedLink::where('visited_id', $user_id)->select('id','visited_id', DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as created_at "), DB::raw('sum(price) as price'), DB::raw('count(price) as click_count'))
            ->groupBy(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')")
            )
            ->with(['v_user' => function ($q) {
            return $q->select('id','fname','lname','email','mobile','image_path','created_at');
        }])

            ->orderBy('id','DESC')
            ->paginate(100);



        return view('layouts.material.admin.users.salary_list', compact('salary'));
    }


    public function list($type='all')
    {

        $search = Input::get('search', '');

         $users = User::where('is_admin', 0)->SearchByKeyword($search)
            ->withCount('visited_links')
            ->withCount('referers')
            ->groupBy('users.id')
            ->orderBy('id', 'DESC');
        if($type!='all'){


            $users= $users->whereHas('getSubcategories')->withCount('getSubcategories')  ;
        }
        $users=$users->paginate(50);


//        foreach ($users as $user) {
//            if ($user->id > 1 && $user->id < 100) {
//                User::where('id', $user->id)->update(['country'=> ip_info($user->ip, "Country")]);
//            }
//
//        }
        return view('layouts.material.admin.users.users_list', compact('users'));
    }


    public function save(Request $request)
    {


        $this->validate($request, [
            'fname' => 'required|max:255',
            'type' => 'required',
            'mobile' => 'required|min:10|unique:users',
            'main_code_melli' => 'required|min:10|unique:users',
            'code_melli' => 'required|min:8|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);


        $result = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request['email'],
            'code_melli' => $request['code_melli'],
            'main_code_melli' => $request['main_code_melli'],
            'username' => $request['code_melli'],

            'image_path' => "profile.png",
            'type' => $request->type,
            'is_admin' => 0,
            'password' => Hash::make($request->password),
        ]);


        if ($result)
            flash()->success('توجه', 'user add successfully');
        else
            flash()->error('توجه', 'error');


        return back();

    }


    public function new()
    {

        return view('layouts.material.admin.users.create_user');
    }

    public function edit($id)
    {
        $users = User::find($id);
        return view('layouts.material.admin.users.edit_user', compact('users'));
    }

    public function modify($id, Request $request)
    {
        $this->validate($request, [
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'type' => 'required',


        ]);


        try {
            User::where('id', $id)->update([
                'fname' => $request->fname,
                'lname' => $request->lname,

                'type' => $request->type,

            ]);
        } catch (Exception $exception) {
            return back()->with('error', 'خطا در ویرایش');

        }


        return back()->with('success', 'اطلاعات با موفقیت ویرایش شد');


    }

    public function active($id, $is_active)
    {
        User::where('id', $id)->update(['is_active' => $is_active * -1]);

        return back();

    }


    public function send_message_to_all_user(Request $request)
    {
        $store_path = '/images/message/';

        $image = UpLoad::create('image')
            ->request($request)
            ->target('main_image')
            ->store_path($store_path)
//            ->watermark_path('watermark_logo.png')
//            ->resizePercentage(80)
//            ->resize_percent(75)
            ->makeUpload();

        Message::create(
            [
                'title' => $request->title,
                'description' => $request->description,

                'image_path' => $image['image_path'][0],

                'is_public' => 1,
                'status' => 1,
            ]
        );

        if (isset($request->telegram)) {
            $user = User::where('chat_id', '>', 0)->pluck('chat_id');
            $text = $request->title;
            $text .= "\n";
            $text .= $request->description;
            sendMessageToBot($text, $user->toArray());
        }
        return back()->with('success', 'پیام با موفقیت ارسال شد.');
    }

    public function send_message_to_user(Request $request)
    {


        $store_path = '/images/message/';

        $image = UpLoad::create('image')
            ->request($request)
            ->target('main_image')
            ->store_path($store_path)
//            ->watermark_path('watermark_logo.png')
//            ->resizePercentage(80)
//            ->resize_percent(75)
            ->makeUpload();

        $message = Message::create(
            [
                'title' => $request->title,
                'description' => $request->description,

                'image_path' => $image['image_path'][0],

                'is_public' => 0,
                'status' => 1,
            ]
        );
        $message->users()->attach([$request->user_id]);

        if (isset($request->telegram)) {
            $user = User::select('chat_id')->find($request->user_id);
            $text = $request->title;
            $text .= "\n";
            $text .= $request->description;
            sendMessageToBot($text, $user->chat_id);
        }

        if (isset($request->email)) {
            $user = User::select('fname', 'lname', 'email')->find($request->user_id);
            SEND_MESSAGE_WITH_MAIL($user->fname . " " . $user->lname, $user->email, $request->title, $request->description);
        }
        return back()->with('success', 'پیام با موفقیت ارسال شد.');
    }

    public function message_list(Request $request)
    {
        $messages = Message::with('users')->orderBy('id', 'DESC')->paginate(20);

        if ($request->ajax()) {
            try {
                return view('admin.message.table', compact('messages'))->render();
            } catch (\Throwable $e) {
            }
        }
        return view('layouts.material.admin.message.list', compact('messages'));

    }

}
