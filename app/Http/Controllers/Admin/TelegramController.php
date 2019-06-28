<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Telegram\Bot\Api;
use Telegram\Bot\Exceptions\TelegramSDKException;

class TelegramController extends Controller
{

    private $telegram;

    public function __construct()
    {
        try {
            $this->telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
        } catch (TelegramSDKException $e) {
        }

    }

    public function edit_web_hook()
    {


        return view('admin.telegram.edit_web_hook');
    }

    public function modify_web_hook()
    {
        $url = Input::get('url', '');
        $action = Input::get('action', 'set');


        $error = null;
        try {
            $res = ($action == 'set') ? $this->telegram->setWebhook(['url' => $url]) : $this->telegram->removeWebhook();
        } catch (TelegramSDKException $e) {
            $error = $e->getMessage();


        }
        return back()->withErrors([$error]);
    }


    private function curl_get_contents($url, $params)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, count($params));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }


}
