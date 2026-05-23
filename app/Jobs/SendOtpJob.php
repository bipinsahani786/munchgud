<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Services\NotificationService;

class SendOtpJob implements ShouldQueue
{
    use Queueable;

    public $contact;
    public $otp;

    public function __construct($contact, $otp)
    {
        $this->contact = $contact;
        $this->otp = $otp;
    }

    public function handle(): void
    {
        app(NotificationService::class)->sendOtp($this->contact, $this->otp);
    }
}
