<?php

namespace App\Repositories;

use App\Mail\OrderReport;
use App\Repositories\Contracts\ReportRepositoryInterface;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;

class ReportRepository implements ReportRepositoryInterface
{
    public function generateOrderPdf($orderDetails)
    {
        return PDF::loadView('pdfs.order_report', compact('orderDetails'));
    }

    public function sendOrderReport($email, $orderDetails, $pdf)
    {
        return Mail::to($email)->send(new OrderReport($orderDetails, $pdf));
    }
}