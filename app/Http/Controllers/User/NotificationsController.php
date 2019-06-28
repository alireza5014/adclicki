<?php

namespace App\Http\Controllers\User;

use App\Model\Notification;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class NotificationsController extends Controller
{
    public function notification()
    {

//        $user=User::get();
//        foreach ($user as $item) {
//            Notification::create(
//                [
//                    'user_id' => $item->id
//                ]
//            );
//        }
        $notification = Notification::where('user_id', getUserId())->first();
        return view('layouts.material.user.notification', compact('notification'));

    }

    public function modify(Request $request)
    {
//return $request->all();

        try {
            $n = Notification::where('user_id', getUserId())->first();
            Notification::where('user_id', getUserId())->update(
                [
                    $request->key => $n[$request->key]*-1,
                ]
            );
            $status = 1;

        } catch (Exception $exception) {
            $status = 0;
        }

        return response()->json(
            [
                'status' => $status,
                'message' => $request->all(),

            ]
            , 200
        );
    }
}
