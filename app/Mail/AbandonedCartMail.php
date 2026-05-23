<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AbandonedCartMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $cartItems;
    public $discountCode;

    public function __construct($cartItems, $discountCode = null)
    {
        $this->cartItems = $cartItems;
        $this->discountCode = $discountCode;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Did you forget something? - MunchGud',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.abandoned-cart',
        );
    }
}
