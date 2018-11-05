<?php

namespace App\Exceptions;


use Exception;

class LinkServiceException extends Exception
{
    const LINK_ALREADY_EXIST = 1;
    const URL_NOT_FOUND = 2;
    const URL_WAS_EXPIRED = 3;


    public function __construct($error)
    {
        $msg = 'Unknown error';
        $code = 400;

        switch ($error) {
            case self::LINK_ALREADY_EXIST:
                $msg = 'Specified custom link already exist';
                $code = 200;
                break;
            case self::URL_NOT_FOUND:
                $msg = 'Url not found';
                $code = 404;
                break;
            case self::URL_WAS_EXPIRED:
                $msg = 'Url was expired';
                $code = 410;
                break;
        }

        parent::__construct($msg, $code);
    }
}