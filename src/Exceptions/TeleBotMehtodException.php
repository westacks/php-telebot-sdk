<?php

namespace WeStacks\TeleBot\Exceptions;

use Exception;

class TeleBotMehtodException extends Exception
{
    public static function methodNotFound(string $method)
    {
        return new TeleBotMehtodException("Method \"$method\" is not exists", 404);
    }
}