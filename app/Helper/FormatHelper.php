<?php

namespace App\Helper;

class FormatHelper
{
    static public function formatYen(int $price): string
    {
        return '¥' . number_format($price);
    }
}
