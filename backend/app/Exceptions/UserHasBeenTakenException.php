<?php

namespace App\Exceptions;

use Exception;

class UserHasBeenTakenException extends Exception
{
    /**
     * @var string
     */
    protected $message = 'User has been taken.';

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
