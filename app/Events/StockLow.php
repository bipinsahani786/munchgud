<?php

namespace App\Events;

use App\Models\ProductSku;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StockLow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public ProductSku $sku;

    public function __construct(ProductSku $sku)
    {
        $this->sku = $sku;
    }
}
