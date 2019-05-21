<?php

namespace App\Services\Payment;

use App\Mail\SendAnswerMail;
use App\Models\Answer;
use Illuminate\Support\Facades\Mail;

class SendAnswer
{
    public function send(string $email, Answer $answer): void
    {
        Mail::to($email)->send(new SendAnswerMail($email, $answer));
    }
}