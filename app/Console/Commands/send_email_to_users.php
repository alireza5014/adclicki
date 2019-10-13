<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class send_email_to_users extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send_to_users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {



       $description="بیشتر از یک ماه از عدم فعالیت شما در سایت اد کلیکی می گذرد. شما می توانید وارد حساب کاربری خود شوید و با کلیک کردن و جستجوی آگهی و خرید زیر مجموعه اجاره ای درآمد کسب کنید. ";
       $description.="\n";
       $description.="واریزی ها به محض ثبت درخواست پرداخت می شود";
       $description.="\n";

       $description.="آدرس سایت ادکلیکی :" .url('');

       SEND_MESSAGE_WITH_MAIL("ali","persian402@gmail.com","1 کسب درآمد از سایت ادکلیکی ",$description);


    }


}
