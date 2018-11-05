<?php

namespace App\Tools;


class StringGenerator
{
    public static function generate($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersCount = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersCount - 1)];
        }

        return $randomString;
    }
}