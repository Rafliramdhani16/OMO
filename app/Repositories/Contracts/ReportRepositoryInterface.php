<?php

namespace App\Repositories\Contracts;

interface ReportRepositoryInterface
{
    public function generateOrderPdf($orderDetails);
    public function sendOrderReport($email, $orderDetails, $pdf);
}