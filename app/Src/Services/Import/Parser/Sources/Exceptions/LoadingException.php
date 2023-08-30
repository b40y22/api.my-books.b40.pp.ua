<?php

namespace App\Src\Services\Import\Parser\Sources\Exceptions;


use Exception;

class LoadingException extends Exception
{
    public function __construct()
    {
        // Тут має бути подія яка перемкне стан зовнішнього сайта на "не доступен"
    }
}
