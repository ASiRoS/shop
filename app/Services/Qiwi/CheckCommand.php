<?php

namespace App\Services\Qiwi;

use Fruitware\QiwiServiceProvider\Model\Method\Check\CheckRequest;
use Fruitware\QiwiServiceProvider\Model\Method\Check\CheckResponse;

class CheckCommand extends CheckRequest
{
    /**
     * Internal logic processing
     *
     * @return CheckResponse
     */
    public function process()
    {
        // some your logic here

        /**
         * @var CheckResponse $response
         */
        $response = $this->getResponse();

        return $response
            ->setOsmpTxnId($this->getTxnId()) // required
            ->setResult(0) // required
            ->setComment('some Check comment') // not required
            ;
    }
}