<?php

namespace App\Models;

class Setting
{
    public const YANDEX_WALLET = 410017256608697;

    public static function getYandexWallet(): int
    {
        return self::YANDEX_WALLET;
    }
}