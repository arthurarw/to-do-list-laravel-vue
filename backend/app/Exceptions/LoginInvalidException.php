<?php

namespace App\Exceptions;

use Exception;

/**
 * Class LoginInvalidException
 * @package App\Exceptions
 */
class LoginInvalidException extends Exception
{
    /**
     * @var string
     */
    protected $message = 'Email and password don\'t match.';

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function render()
    {
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage()
        ], 401);
    }
}
