<?php

namespace App\Http\Controllers;

use Qiwi\Api\BillPayments;

class TestController
{
    public function __invoke()
    {
        $sk = 'eyJ2ZXJzaW9uIjoiUDJQIiwiZGF0YSI6eyJwYXlpbl9tZXJjaGFudF9zaXRlX3VpZCI6ImlnZWYtMDAiLCJ1c2VyX2lkIjoiNzkxNjg3MTY0NjQiLCJzZWNyZXQiOiJlZjg1ZjMzODg0NTllYmY0MGI2ZjUzYjJiZmE2MTY2MGI4YjM1MjQyZjM1OWEwOWEzMmRjZjkxODdkNTAxZWU1In19';
        $pk = 'aixoQYoWQNPF2isu7ENmR6kPNgGvn8hYQ71aJfEc3T6wmprcWhNiRqDC9VRpT382yfHARYUKDqEgCEFatYkZ5bQmWbTgH25KDUgd7oskaPjG9vw2jDJkuvj8yFDxa1jxHCYi4XQGg9wGphAtohrkdzLjKzzwpMQvZaR963BbwzrrEVGXxqGN7GMbye';

        $billPayments = new BillPayments($sk);

        $params = [
            'publicKey' => $pk,
            'amount' => 200,
            'billId' => $billPayments->generateId(),
            'successUrl' => route('payment.success'),
        ];

        /** @var \Qiwi\Api\BillPayments $billPayments */
        $link = $billPayments->createPaymentForm($params);

        return view('test.test', compact('link'));
    }
}