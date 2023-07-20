<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class ExternalServiceException extends Exception
{
    /**
     * @var string
     */
    protected $message = 'External service send wrong response';

    /**
     * @var int
     */
    protected $code;

    /**
     * @param string $message
     * @param int $code
     */
    public function __construct(string $message = '', int $code = 400)
    {
        parent::__construct();
        $this->code = $code;
        $this->message = strlen($message) > 0 ? $message : $this->message;
    }

    /**
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return response()->json(['data' => [], 'errors' => [$this->message]], $this->code);
    }
}
