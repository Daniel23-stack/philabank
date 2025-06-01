<?php

namespace App\Listeners;

use App\EmailTemplate;
use App\Mail\GeneralMail;
use App\Models\EmailSMSTemplate;
use App\Utilities\Overrider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Mail;

class SendWelcomeNotification {
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct() {
        Overrider::load("Settings");
    }

    /**
     * Handle the event.
     *
     * @param  Verified  $event
     * @return void
     */
    public function handle(Verified $event) {
        $user = $event->user;

        if ($user->email_verified_at == null) {
            return;
        }

        $template       = EmailSMSTemplate::where('slug', 'WELCOME_EMAIL')->first();

        if ($template->email_status == 0) {
            return;
        }
        //Replace paremeter
        $replace = array(
            '{{name}}'           => $user->name,
            '{{email}}'          => $user->email,
            '{{phone}}'          => $user->phone,
            '{{account_number}}' => $user->account_number,
        );

        //Send Welcome email 
        $template->body = process_string($replace, $template->email_body);

        try {
            Mail::to($user->email)->send(new GeneralMail($template));
        } catch (\Exception $e) {
            //Nothing
        }
    }
}
