<?php

namespace App\Telegram;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;


class TestCommand extends Command{

    protected $name = 'test';

    protected $description = 'Test command, Get a list of commands';

    public function handle($arguments)
    {
        $this->replyWithChatAction(['action' => Actions::TYPING]);

        // $user = \App\User::find(1);
        // $this->replyWithMessage(['text' => 'Почта пользователя: ' . $user->email]);
        $telegram_user = \Telegram::getWebhookUpdates()['message'];
        
        $text = sprintf('%s - %s'.PHP_EOL, 'Ваш номер чата' , $telegram_user['from']['id']);
        if($telegram_user['from']['username']) {
        $text .= sprintf('%s - %s'.PHP_EOL, 'Ваше имя пользователя' , $telegram_user['from']['username']);
        }
        $keyboard = [
          ['1','2'],
          ['3','4'],
          ['5','8']
        ];


        $reply_markup = \Telegram::replyKeyboardMarkup([
          'keyboard' => $keyboard,
          'resize_keyboard' => true,
          //'one_time_keyboard' => true
        ]);

        $response = \Telegram::sendMessage([
          'chat_id' => $telegram_user['from']['id'],
          'text' => 'Hello',
          'reply_markup' => $reply_markup
        ]);

        $messageId = $response->getMessageId();
//file_put_contents('test.txt', var_export($messageId, true) . "\r\n\r\n", FILE_APPEND | LOCK_EX);
         $this->replyWithMessage(compact('text'));
    }
}
