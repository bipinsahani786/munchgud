<?php

namespace App\Listeners;

use App\Events\OrderStatusUpdated;
use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendOrderStatusEmail implements ShouldQueue
{
    public function __construct()
    {
        //
    }

    public function handle(OrderStatusUpdated $event): void
    {
        app(NotificationService::class)->sendStatusUpdate($event->order);
    }
}
