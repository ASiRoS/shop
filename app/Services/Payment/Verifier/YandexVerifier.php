<?php

namespace App\Services\Payment\Verifier;

class YandexVerifier
{
    private const NOTIFICATION_SECRET = 'tgor8Lm9deacQi2IGQYeTPU1';

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

    public function verify(string $hash, array $data): bool
    {
        return
            ($this->generate($data) === $hash) &&
            ($data['codepro'] === true) &&
            ($data['unaccepted'] === false)
            ;
    }

    /**
     * Generates hash.
     * @param array $data
     * @return string
     */
    private function generate(array $data): string
    {
        $params = array_map(function(string $param) use($data) {
            return $param === 'notification_secret' ? self::NOTIFICATION_SECRET : $data[$param];
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
}