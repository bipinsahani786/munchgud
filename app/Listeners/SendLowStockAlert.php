<?php

namespace App\Listeners;

use App\Events\StockLow;
use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendLowStockAlert implements ShouldQueue
{
    public function __construct()
    {
        //
    }

    public function handle(StockLow $event): void
    {
        app(NotificationService::class)->sendLowStockAlert($event->sku);
    }
}
