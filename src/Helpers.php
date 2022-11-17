<?php

namespace Alphaolomi\Swahilies;

/**
 * Helper functions
 * @version 1.0
 * @author Alpha Olomi
 */
class Helpers
{
    public static function cleanPhoneNumber($phone)
    {
        // only numbers
        $phone = preg_replace('/[^0-9]/', '', $phone);
        // if has only 10 chars
        if (strlen($phone) == 10) {
            // append 255
            $phone = '255'.$phone;
        }

        return $phone;
    }

    public static function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
