<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use App\Jobs\GenerateInvoiceJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GenerateInvoicePdf implements ShouldQueue
{
    public function __construct()
    {
        //
    }

    public function handle(OrderPlaced $event): void
    {
        dispatch(new GenerateInvoiceJob($event->order));
    }
}
