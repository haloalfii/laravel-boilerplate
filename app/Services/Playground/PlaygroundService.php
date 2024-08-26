<?php

namespace App\Services\Playground;

use App\Base\ServiceBase;
use App\Repositories\Playground\PlaygroundRepositories;
use App\Responses\ServiceResponse;
use Illuminate\Support\Facades\Log;

class PlaygroundService extends ServiceBase {
    protected PlaygroundRepositories $playgroundRepositories;

    public function __construct()
    {
        $this->playgroundRepositories = new PlaygroundRepositories();
    }
    /**
     * main method of this service
     *
     * @return ServiceResponse
     */
    public function call(): ServiceResponse {
        try{
            $data = $this->playgroundRepositories->playground();
            return self::success($data);
        }catch (\Throwable $th) {
            Log::error('PlaygroundService', [
                'Message ' => $th->getMessage(),
                'On file ' => $th->getFile(),
                'On line ' => $th->getLine()
            ]);

            return self::error(null, $th->getMessage());
        }
    }
}
