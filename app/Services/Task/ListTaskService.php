<?php

namespace App\Services\Task;

use App\Base\ServiceBase;
use App\Repositories\Task\TaskRepositories;
use App\Responses\ServiceResponse;
use Illuminate\Support\Facades\Log;

class ListTaskService extends ServiceBase {
    protected TaskRepositories $taskRepo;

    public function __construct(protected array $data)
    {
        $this->taskRepo = new TaskRepositories();
    }

    /**
     * main method of this service
     *
     * @return ServiceResponse
     */
    public function call(): ServiceResponse {
        try{
            $data = $this->taskRepo->list($this->data);

            return self::success($data->original['data']);
        }catch (\Throwable $th) {
            Log::error('ListTaskService ', [
                'Message ' => $th->getMessage(),
                'On file ' => $th->getFile(),
                'On line ' => $th->getLine()
            ]);

            return self::error(null, $th->getMessage());
        }
    }
}
