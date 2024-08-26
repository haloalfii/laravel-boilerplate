<?php

namespace App\Base;

use App\Contracts\ServiceContract;
use App\Responses\ServiceResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

abstract class ServiceBase implements ServiceContract {

    /**
     * To return success response of the service
     *
     * @param $result
     * @param string $message
     * @return ServiceResponse
     */
    protected static function success($result, string $message = 'true', int $http_code = 200): ServiceResponse {
        return (new ServiceResponse($result, $message, true))->setHttpCode($http_code);
    }

    /**
     * To return error response of the service
     *
     * @param $result
     * @param string $message
     * @param int $status
     * @return ServiceResponse
     */
    protected static function error($result, string $message = "error", bool $status = false, int $http_code = 400): ServiceResponse {
        return (new ServiceResponse($result, $message, $status))->setHttpCode($http_code);
    }

    protected static function catchError(\Throwable $th, $result, string $message = "error"):ServiceResponse
    {
        Log::error($th->getMessage(), [
            'file' => $th->getFile(),
            'line' => $th->getLine()
        ]);
        return (new ServiceResponse($result, $message, false))->setHttpCode(Response::HTTP_BAD_REQUEST);
    }
}
