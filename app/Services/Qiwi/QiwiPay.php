<?php

namespace App\Services\Qiwi;

use Qiwi\Api\BillPayments;

class QiwiPay
{
    public const PRIVATE_KEY = 'eyJ2ZXJzaW9uIjoiUDJQIiwiZGF0YSI6eyJwYXlpbl9tZXJjaGFudF9zaXRlX3VpZCI6ImlnZWYtMDAiLCJ1c2VyX2lkIjoiNzkxNjg3MTY0NjQiLCJzZWNyZXQiOiJlZjg1ZjMzODg0NTllYmY0MGI2ZjUzYjJiZmE2MTY2MGI4YjM1MjQyZjM1OWEwOWEzMmRjZjkxODdkNTAxZWU1In19';
    public const PUBLIC_KEY = 'aixoQYoWQNPF2isu7ENmR6kPNgGvn8hYQ71aJfEc3T6wmprcWhNiRqDC9VRpT382yfHARYUKDqEgCEFatYkZ5bQmWbTgH25KDUgd7oskaPjG9vw2jDJkuvj8yFDxa1jxHCYi4XQGg9wGphAtohrkdzLjKzzwpMQvZaR963BbwzrrEVGXxqGN7GMbye';

    private $billPayments, $billId;

    public function __construct()
    {
        $this->billPayments = new BillPayments(self::PRIVATE_KEY);
    }

    public function getLink(int $cost): string
    {
        return $this->billPayments->createPaymentForm([
            'publicKey' => self::PUBLIC_KEY,
            'amount' => $cost,
            'billId' => $this->billPayments->generateId(),
            'successUrl' => route('payment.success'),
        ]);
    }

    public function getBillId(): ?string
    {
        return $this->billId;
    }
}