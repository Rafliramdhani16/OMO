<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderReport extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $orderDetails;
    public $pdf;

    public function __construct($orderDetails, $pdf)
    {
        $this->orderDetails = $orderDetails;
        $this->pdf = $pdf;
    }

    public function build()
    {
        return $this->view('emails.order_report')
                    ->subject('Order Confirmation #' . $this->orderDetails->booking_trx_id)
                    ->attachData($this->pdf->output(), 'order_report.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}