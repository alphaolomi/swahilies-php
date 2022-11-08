<?php

namespace Alphaolomi\Swahilies;

class Helpers
{
    public static function cleanPhoneNumber($phone)
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);
        if (strlen($phone) == 10) {
            $phone = '255' . $phone;
        }
        return $phone;
    }
}
