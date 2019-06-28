<?php

namespace App\Http\Controllers\User;

use App\Model\Message;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessagesController extends Controller
{
    public function message(Request $request)
    {
        $messages = Message::whereHas('users', function ($q) {
            return $q->where('users.id', getUserId());
        })
            ->where('is_public', 0)
            ->orderBy('id', 'DESC')
            ->get();

        $pub_messages = Message::where('is_public', 1)
            ->orderBy('id', 'DESC')
            ->get();
        foreach ($pub_messages as $message) {
            $messages[]=$message;
        }


        if ($request->ajax()) {
            try {
                return view('layouts.material.user.message.table', compact('messages'))->render();
            } catch (\Throwable $e) {
            }
        }


        return view('layouts.material.user.message.list', compact('messages'));
    }
}
