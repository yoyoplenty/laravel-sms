<?php

namespace App\Listeners;

use App\Mail\VerificationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendVerificationEmail {
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
        $hashed = Crypt::encryptString($event->user->uuid);

        Mail::to($event->user)->send(new VerificationMail($event->user, $hashed));
    }
}
