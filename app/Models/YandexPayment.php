<?php

namespace App\Models;

use Illuminate\Http\Request;

class YandexPayment
{
    public const NOTIFY_CODE = 'tgor8Lm9deacQi2IGQYeTPU1';

    private const PARAMS = [
        'notification_type',
        'operation_id',
        'amount',
        'currency',
        'datetime',
        'sender',
        'codepro',
        'notification_secret',
        'label'
    ];

    /**
     * @var Request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function generateSha1(): string
    {
        $params = array_map(function (string $param) {
            return $param === 'notification_secret' ? self::NOTIFY_CODE : $this->request->get($param);
        }, self::PARAMS);

        $count = count($params);
        $last = $count - 1;

        $result = '';

        for($i = 0; $i < $count; $i++) {
            $result .= $params[$i];

            if($i !== $last) {
                $result .= '&';
            }
        }

        return sha1($result);
    }

    /**
     * Is code protection turned on
     * @return bool
     */
    public function isProtected(): bool
    {
        return $this->request->get('codepro') == true;
    }

    public function isAccepted(): bool
    {
        return $this->request->get('unaccepted') == false;
    }

    public function isShaCorrect(): bool
    {
        return $this->request->get('sha1_hash') === $this->generateSha1();
    }

    public function isCorrect(): bool
    {
        return !$this->isProtected() && $this->isAccepted();
    }
}