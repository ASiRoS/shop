<?php

namespace App\Services\Payment;

use App\Mail\SendAnswerMail;
use App\Models\Answer;
use App\Models\Purchase;
use Illuminate\Support\Facades\Mail;

class SendAnswer
{
    public function send(Purchase $purchase): void
    {
        $answer = Answer::byProduct($purchase->product);

        Mail::to($purchase->customer)->send(new SendAnswerMail($purchase->customer, $answer));
    }
}