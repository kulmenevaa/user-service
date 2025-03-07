<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

abstract class Controller
{
    public function responseJson(mixed $response, int $status = JsonResponse::HTTP_OK): JsonResponse
    {
        return new JsonResponse($response, $status);
    }
}
