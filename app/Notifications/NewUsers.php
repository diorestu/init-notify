<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\Telegram\TelegramMessage;

class NewUsers extends Notification
{
    use Queueable;
    protected $msg;
    public function __construct($msg)
    {
        $this->msg = $msg;
    }

    public function via($notifiable)
    {
        return ['telegram'];
    }

    public function toTelegram($notifiable)
    {
        return TelegramMessage::create()
            ->to('112944647')
            // ->content("Hello there!\nYour invoice has been *PAID*")
            ->content('1 Pengguna Baru a/n: ' . $this->msg . ' telah mendaftar ke Init Notification');
    }
}
