<?php

namespace App\Http\Controllers\Telegram;


use App\Http\Controllers\Controller;

use App\Model\Ads;
use App\Model\VisitedLink;
use App\User;
use Telegram\Bot\Api;
use Telegram\Bot\Exceptions\TelegramSDKException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


class TelegramController extends Controller
{


    private $method = 'sendMessage';
    private $reply_markup;

    private $type;
    // adclicki_bot
    private $token;
    private $chat_id;
    private $text = 0;
    private $msg = 0;
    private $name = '1';
    private $username = '2';
    private $user_id = '2';


    public function __construct()
    {
        $this->token = env('TELEGRAM_BOT_TOKEN');
    }

    private function menu()
    {
        $this->reply_markup = json_encode([//Because its object
            'inline_keyboard' => [
                [
                    [
                        'text' => 'تعداد آگهی های  قابل کلیک ', 'callback_data' => 'click_link_count',
                    ]

                ]
                ,
                [
                    [
                        'text' => 'تعداد آگهی های  قابل جستجو گوگل', 'callback_data' => 'google_link_count',
                    ]

                ]
                ,
                [
                    [
                        'text' => 'موجودی کل من', 'callback_data' => 'total_balance',
                    ],
                    [
                        'text' => 'درآمد امروز من', 'callback_data' => 'today_income',
                    ]

                ]
                ,

                [
                    [
                        'text' => 'تعداد زیر مجموعه های من', 'callback_data' => 'referrer_count',
                    ]
                ]
                ,
                [
                    [
                        'text' => 'درآمد حاصل از زیر مجموعه ها', 'callback_data' => 'referrer_income',
                    ]
                ]
                ,
                [
                    [
                        'text' => 'گرفتن زیرمجموعه', 'callback_data' => 'get_referrer',
                    ]
                ]
            ],

        ]);

    }

    private function start_code()
    {

        $user_id = base64_decode(ltrim($this->text, "/start code_"));

        $this->method = 'sendMessage';

        $res = User::where('id', $user_id)->update(['chat_id' => $this->chat_id]);
        if ($res) {
            $user = User::find($user_id);
        }

        $this->menu();
        $this->msg = "سلام ! " . $user->fname . " " . $user->lname . "\n";
        $this->msg .= "به ربات اد کلیکی خوش آمدید به ربات اد کلیکی خوش آمدید";
    }

    private function start()
    {
        $this->method = 'sendMessage';
        $this->reply_markup = json_encode([//Because its object
            'hide_keyboard' => true
        ]);

        $this->msg = "سلام ! " . $this->name;
        $this->msg .= "\n";
        $this->msg .= "کد فعالسازی خود را وارد کنید!";
    }


    public function action()
    {


        try {

            $telegram = new Api($this->token);
            $update = $telegram->getWebhookUpdates();
            $this->reply_markup = json_encode([//Because its object
                'hide_keyboard' => true
            ]);


            if ($update->getMessage() !== NULL) {
                $this->chat_id = $update->getMessage()->getChat()->getId();
                $this->text = $update->getMessage()->getText();
                $this->type = $update->getMessage()->getType();

                try {
                    $this->name = $update->getMessage()->getFrom()['first_name'];
                    $this->username = $update->getMessage()->getFrom()['username'];

                } catch (\Exception $e) {
                    file_put_contents('username', $e->getMessage());

                }

                if ($this->text == '/start') {


                    $this->start();


                } elseif (substr($this->text, 0, 6) == '/start') {


                    $this->start_code();

                } else {
                    $user = User::where('id', base64_decode($this->text))->first();
                    if ($user) {
                        if ($user->chat_id == 0) {
                            $res = User::where('id', base64_decode($this->text))->update(['chat_id' => $this->chat_id]);

                            $this->menu();


                            $this->msg = "سلام ! " . $user->fname . " " . $user->lname . "\n";
                            $this->msg .= "به ربات اد کلیکی خوش آمدید به ربات اد کلیکی خوش آمدید";
                        }
                    } else {
                        $this->reply_markup = json_encode([//Because its object
                            'hide_keyboard' => true
                        ]);


                        $this->msg = "کد فعالسازی صحیح نمی باشد!";
                    }


                }


            } else {


                $callbackQuery = $update->getCallbackQuery();
                if ($callbackQuery !== NULL) {
                    // You can use now callbackQuery
                    // Get the callbackQuery data with:
                    $this->text = $callbackQuery->getData();
                    $this->chat_id = $callbackQuery->getFrom()->getId();

                    $my_user = User::select('id')->where('chat_id', $this->chat_id)->first();
                    $this->user_id = $my_user->id;

                    $this->reply_markup = json_encode([//Because its object
                        'inline_keyboard' => [
                            [
                                [
                                    'text' => 'منوی اصلی', 'callback_data' => 'main_menu',
                                ]

                            ]

                        ],

                    ]);

                    switch ($this->text) {

                        case 'click_link_count':
                            $this->click_link_count();
                            break;

                        case 'google_link_count':
                            $this->google_link_count();
                            break;
                        case 'total_balance':
                            $this->total_balance();
                            break;
                        case 'today_income':
                            $this->today_income();
                            break;
                        case 'referrer_count':
                            $this->referrer_count();
                            break;
                        case 'referrer_income':
                            $this->referrer_income();
                            break;
                        case 'get_referrer':
                            $this->get_referrer($telegram);
                            break;
                        case 'main_menu':
                            $this->main_menu();
                            break;

                        default :
                            $this->msg = $this->text;
                    }
                }


            }


            $this->run($telegram, $this->method);


        } catch
        (\Exception $e) {
            file_put_contents('ERROR', $e->getMessage());

        }


    }


    private function click_link_count()
    {

        $ads_count = getTodayUnClickedLink($this->user_id, 0);


        $this->msg = "تعداد آگهی های کلیکی کلیک نشده شما " . $ads_count . " عدد می باشد.";

    }

    private function google_link_count()
    {

        $ads_count = getTodayUnClickedLink($this->user_id, 1);

        $this->msg = "تعداد آگهی های جستجوی گوگل کلیک نشده شما " . $ads_count . " عدد می باشد.";

    }

    private function total_balance()
    {

        $this->msg = "موجودی کل شما " . getTotalBalance($this->user_id) . " تومان می باشد .";


    }

    private function today_income()
    {


        $this->msg = "درآمد امروز شما " . getTodayIncome($this->user_id) . " تومان می باشد .";


    }

    private function referrer_count()
    {
        $this->msg = "تعداد زیر مجموعه های شما " . getReferercount($this->user_id) . " عدد می باشد .";


    }

    private function referrer_income()
    {

        $this->msg = "درآمد حاصل از زیر مجموعه های شما " . getRefererIncome($this->user_id) . " تومان می باشد.";


    }

    private function get_referrer($telegram)
    {


        $this->msg = "برای گرفتن زیر مجموعه می توانید متن بالا را به دوستانتان فوروارد کنید. با ثبت نام هر یک از دوستانتان در سایت اد کلیکی ۲۰ درصد از درآمد آنها به شما تعلق خواهد گرفت.";


        $telegram->sendPhoto(
            [
                'chat_id' => $this->chat_id,
                'photo' => 'referrer.png',
                'caption' => 'شما با ثبت نام ( رایگان ) در سایت  اد کلیکی می توانید با کلیک روی آگهی و مشاهده تبلیغاتی که در سایت ثبت شده درآمد کسب نموده
و از درآمد خود برای تبلیغات خود استفاده نمائید ویا با ثبت درخواست پرداخت در اسرع وقت مبلغ درخواستی شما به حسابتان واریز گردد
اگر دنبال درآمد هستید ثبت نام کنید و وارد پروفایل خود شده و بر روی آگهی ها سایت کلیک کنید
 ' . "\n" . url('user/register') . "?referer_id=" . $this->user_id
            ]);

    }

    private function main_menu()
    {

        $this->menu();

        $this->msg = "منوی اصلی";

    }


    private function run($telegram, $method = 'sendMessage')
    {


        switch ($method) {


            case 'sendMessage':
                $telegram->sendMessage(
                    [
                        'chat_id' => $this->chat_id,
                        'text' => $this->msg,
                        'reply_markup' => $this->reply_markup
                    ]);
                break;

        }
    }


}