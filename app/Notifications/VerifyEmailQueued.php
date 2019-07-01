<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use Illuminate\Auth\Notifications\VerifyEmail;

//class VerifyEmailQueued extends Notification
class VerifyEmailQueued extends VerifyEmail implements ShouldQueue
{
    use Queueable;

}
