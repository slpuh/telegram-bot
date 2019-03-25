<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Telegram;
use App\TelegramUser;

class TelegramController extends Controller
{
    public function webhook() {
      $telegram = Telegram::getWebhookUpdates()['message'];
      //file_put_contents('test.txt', var_export(json_decode($telegram['from'], true), true) . "\r\n\r\n", FILE_APPEND | LOCK_EX);   
      if(!TelegramUser::find($telegram['from']['id'])) {
        TelegramUser::create(json_decode($telegram['from'], true));
      }
    	Telegram::commandsHandler(true);
    }


}
