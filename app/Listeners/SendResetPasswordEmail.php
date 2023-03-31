<?php

namespace App\Listeners;

use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendResetPasswordEmail {
    /**
     * Create the event listener.
     */
    public function __construct() {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void {
        $hashed = Crypt::encryptString($event->user->reset_token);

        Mail::to($event->user)->send(new ResetPasswordMail($event->user, $hashed));
    }
}
