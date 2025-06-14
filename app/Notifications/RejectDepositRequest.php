<?php

namespace App\Notifications;

use App\Channels\SmsMessage;
use App\Models\EmailSMSTemplate;
use App\Utilities\Overrider;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RejectDepositRequest extends Notification {
    use Queueable;

    private $depositRequest;
    private $template;
    private $replace = [];

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($depositRequest) {
        Overrider::load("Settings");
        $this->depositRequest = $depositRequest;
        $this->template       = EmailSMSTemplate::where('slug', 'DEPOSIT_REQUEST_REJECTED')->first();

        $this->replace['name']          = $this->depositRequest->user->name;
        $this->replace['email']         = $this->depositRequest->user->email;
        $this->replace['phone']         = $this->depositRequest->user->phone;
        $this->replace['amount']        = decimalPlace($this->depositRequest->amount, currency($this->depositRequest->method->currency->name));
        $this->replace['depositMethod'] = $this->depositRequest->method->name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable) {
        $channels = ['database'];
        if ($this->template != null && $this->template->email_status == 1) {
            array_push($channels, 'mail');
        }
        if ($this->template != null && $this->template->sms_status == 1) {
            array_push($channels, \App\Channels\SMS::class);
        }
        return $channels;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable) {
        $message = processShortCode($this->template->email_body, $this->replace);

        return (new MailMessage)
            ->subject($this->template->subject)
            ->markdown('email.notification', ['message' => $message]);
    }

    /**
     * Get the sms representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toSMS($notifiable) {
        $message = processShortCode($this->template->sms_body, $this->replace);

        return (new SmsMessage())
            ->setContent($message)
            ->setRecipient($notifiable->country_code . $notifiable->phone);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable) {
        $message = processShortCode($this->template->sms_body, $this->replace);
        return ['message' => $message];
    }
}