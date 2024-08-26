<?php

namespace App\Responses;

use App\Contracts\ResponseContract;

class ServiceResponse implements ResponseContract {
    private int $http_code;

    function setHttpCode(int $http_code) : self {
        $this->http_code = $http_code;
        return $this;
    }
    /**
     * Setter of response service
     *
     * @param $result
     * @param string $message
     * @param int $status
     */
    public function __construct(public $result, public string $message, public bool $status = true) {
        $this->status  = $status;
        $this->message = $message;
        $this->result    = $result;
    }

    public function status(): bool {
        return $this->status;
    }

    public function message(): string {
        return $this->message;
    }

    public function result() {
        return $this->result;
    }

    public function httpCode() {
        return $this->http_code;
    }
}
