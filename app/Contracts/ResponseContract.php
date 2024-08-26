<?php

namespace App\Contracts;

/**
 * Interface of Ours Base Response
 * <br>
 * Implement this Contract when you can create your own 'Response' Class
 */
interface ResponseContract {
    // To distribute of response's statuses
    public function status() : bool;
    // Messages of response
    public function message() : string;
    // To distribute of response's data
    public function result();
}
