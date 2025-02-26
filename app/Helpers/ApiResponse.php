<?php

namespace App\Helpers;

class ApiResponse {
    public static function sendResponse($status, $message, $data = null) {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $status);
    }
}
