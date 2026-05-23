<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class GenerateInvoiceJob implements ShouldQueue
{
    use Queueable;

    public Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function handle(): void
    {
        $pdf = Pdf::loadView('pdf.invoice', ['order' => $this->order]);
        
        $filename = 'invoices/INV-' . $this->order->order_number . '.pdf';
        
        Storage::put($filename, $pdf->output());
    }
}
