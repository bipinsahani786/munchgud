<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendOrderConfirmationEmail implements ShouldQueue
{
    public function __construct()
    {
        //
    }

    public function handle(OrderPlaced $event): void
    {
        app(NotificationService::class)->sendOrderConfirmation($event->order);
    }
}
