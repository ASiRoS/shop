<?php

namespace App\Services\Qiwi;

use Fruitware\QiwiServiceProvider\Model\Method\Pay\PayRequest;
use Fruitware\QiwiServiceProvider\Model\Method\Pay\PayResponse;

class PayCommand extends PayRequest
{
    /**
     * Internal logic processing
     *
     * @return PayResponse
     */
    public function process()
    {
        // some your logic here

        /**
         * @var PayResponse $response
         */
        $response = $this->getResponse();

        return $response
            ->setOsmpTxnId($this->getTxnId()) // required
            ->setPrvTxn(123) // required
            ->setSum($this->getSum()) // required
            ->setResult(0) // required
            ->setComment('some pay comment') // not required
            ;
    }
}