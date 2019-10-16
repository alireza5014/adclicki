<?php

namespace App\Http\Controllers\Telegram;

use App\classes\ImageUpload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Telegram\Bot\Api;


class TextToImageController extends Controller
{


    private $method = 'sendMessage';
    private $reply_markup;

    private $type;
    // adclicki_bot
    private $token;
    private $chat_id;
    private $text = 0;
    private $msg = "_";
    private $caption = "_";
    private $first_name = '1';
    private $last_name = '1';
    private $username = '2';
    private $user_id = '2';


    public function __construct()
    {
//        $this->token = env('TELEGRAM_BOT_TOKEN');
        //TextToImageConvertorBot
        $this->token = '915726023:AAGGKAtwsKs487cHzm3LiINZpD6JtzoyYaY';
    }


    private function start()
    {
        $this->method = 'sendMessage';
        $this->reply_markup = json_encode([//Because its object
            'hide_keyboard' => true
        ]);

        $this->msg = "سلام ! " . $this->first_name . " " . $this->last_name;
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

                file_put_contents('username', $update->getMessage());

                $this->chat_id = $update->getMessage()->getChat()->getId();
                $this->text = $update->getMessage()->getText();

                try {
                    $this->first_name = $update->getMessage()->getFrom()['first_name'];
                    $this->last_name = $update->getMessage()->getFrom()['last_name'];
                    $this->username = $update->getMessage()->getFrom()['username'];

                } catch (\Exception $e) {

                }

                if ($this->text == '/start') {


                    $this->start();


                } elseif (substr($this->text, 0, 6) == '/start') {


                    $this->start_code();

                } else {

                    ImageUpload::makeImageWithText2($this->text, "images/test.png");
                    $this->caption = "";
                    $this->method = 'sendPhoto';

                    $this->reply_markup = json_encode([//Because its object
                        'hide_keyboard' => true
                    ]);


                }


            } else {


            }


            $this->run($telegram, $this->method);


        } catch
        (\Exception $e) {
            file_put_contents('ERROR', $e->getMessage());

        }


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

            case 'sendPhoto':
                $telegram->sendPhoto(
                    [
                        'chat_id' => $this->chat_id,
                        'caption' => $this->caption,

                        'photo' => 'images/test.png',


                    ]);


                break;


        }
    }


}