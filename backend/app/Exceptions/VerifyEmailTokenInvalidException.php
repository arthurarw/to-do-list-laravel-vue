<?php

namespace App\Exceptions;

use Exception;

class VerifyEmailTokenInvalidException extends Exception
{
    /**
     * @var string
     */
    protected $message = 'Token not valid.';

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function render()
    {
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage()
        ], 400);
    }
}
