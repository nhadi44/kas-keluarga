<?php

namespace App\Helpers;


class Currency
{
    public static function format($value)
    {
        return 'Rp. ' . number_format($value, 0, ',', '.');
    }
}
