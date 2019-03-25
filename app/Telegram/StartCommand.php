<?php

namespace App\Telegram;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class StartCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "start";

    /**
     * @var string Command Description
     */
    protected $description = "Start Command to get you started";

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {
      $this->replyWithChatAction(['action' => Actions::TYPING]);
      $telegram_user = \Telegram::getWebhookUpdates()['message'];

      // file_put_contents('test1.txt', var_export($result['callback_query'], true) . "\r\n\r\n", FILE_APPEND | LOCK_EX);
      //$text = sprintf('%s - %s'.PHP_EOL, 'Ваш номер чата' , $telegram_user['from']['id']);
      $keyboard = [
        ['1','2'],
        ['3','4'],
        ['5','8']
      ];

      $reply_markup = \Telegram::replyKeyboardMarkup([
        'keyboard' => $keyboard,
        'resize_keyboard' => true,

      ]);

      $response = \Telegram::sendMessage([
        'chat_id' => $telegram_user['from']['id'],
        'text' => 'Hello World',
        'reply_markup' => $reply_markup
      ]);

       //$this->triggerCommand('test');
    }
}
