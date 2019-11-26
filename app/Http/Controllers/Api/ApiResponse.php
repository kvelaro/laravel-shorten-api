<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

trait ApiResponse
{
    public function sendResponse($code, $message, $data) {
        return response()->json($this->makeSuccessResponse($message, $data), $code);
    }

    public function sendError($code, $message, $data) {
        return response()->json($this->makeErrorResponse($message, $data), $code);
    }

    private function makeSuccessResponse($message, $data) {
        return [
            'success' => true,
            'message' => $message,
            'data'    => $data
        ];
    }

    private function makeErrorResponse($message, $data) {
        return [
            'success' => false,
            'message' => $message,
            'data'    => $data
        ];
    }
}
