<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    /**
     * Return a success response.
     *
     * @param string $message
     * @param array|null $data
     * @return JsonResponse
     */
    public static function success(string $message, mixed $data = null): JsonResponse
    {
        return Response()->json([
            "status" => true,
            "message" => $message,
            "data" => $data
        ], 200);
    }

    /**
     * Return a created response.
     *
     * @param string $message
     * @param array|null $data
     * @return JsonResponse
     */
    public static function created(string $message, mixed $data = null): JsonResponse
    {
        return Response()->json([
            "status" => true,
            "message" => $message,
            "data" => $data
        ], 201);
    }


    /**
     * Return an error response.
     *
     * @param string $message
     * @param array|null $data
     * @param int $errorCode
     * @param array $errors
     * @return JsonResponse
     */
    public static function error(string $message, mixed $data = null,$errorCode = 400, $errors = []): JsonResponse
    {
        return Response()->json([
            "status" => false,
            "message" => $message,
            "data" => $data,
            "errors" => $errors
        ], $errorCode);
    }
}
