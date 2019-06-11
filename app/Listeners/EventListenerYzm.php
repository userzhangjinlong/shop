<?php

namespace App\Listeners;

use App\Events\SendSms;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventListenerYzm
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SendSms  $event
     * @return void
     */
    public function handle(SendSms $event)
    {
        /********************************************
         *
         * 1.当你分发事件之后，这里你可以实现你想做的事情 ...
         * 2.如果一个事件有多个监听器，这里返回false则不会再被其他的监听器获取
         */
        //用 $event->order 来访问 order  这里写发送短信第三方短信发送的逻辑代码
        file_put_contents(base_path('public/Uploads/tmp_captcha.txt'), '给手机:'.$event->mobile.',发送验证码:'.$event->captcha.PHP_EOL, FILE_APPEND);
        return false;
    }
}
