<?php

namespace App\Contracts;

use App\Responses\ServiceResponse;

interface ServiceContract {

    // Service main method
    public function call(): ServiceResponse;

}
