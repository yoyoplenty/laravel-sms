<?php

namespace App\Listeners;

use App\Mail\ResetSuccessfulMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendResetSuccessfulEmail {
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
        Mail::to($event->user)->send(new ResetSuccessfulMail($event->user));
    }
}
