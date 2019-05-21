<?php

namespace App\Mail;

use App\Models\Answer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendAnswerMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var string
     */
    private $email;

    /**
     * @var Answer
     */
    private $answer;

    public function __construct(string $email, Answer $answer)
    {
        $this->email = $email;
        $this->answer = $answer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.answer', [
            'email'  => $this->email,
            'link' => $this->answer->link,
        ]);
    }
}
