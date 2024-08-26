<?php

namespace App\Http\Controllers;

use App\Services\Playground\PlaygroundErrorService;
use App\Services\Playground\PlaygroundService;

class PlaygroundController extends Controller
{
    public function playgroundSuccess(): \Illuminate\Http\JsonResponse
    {
        $service = (new PlaygroundService())->call();
        return response()->json($service, $service->httpCode());
    }

    public function playgroundError(): \Illuminate\Http\JsonResponse
    {
        $service = (new PlaygroundErrorService())->call();
        return response()->json($service, $service->httpCode());
    }
}
