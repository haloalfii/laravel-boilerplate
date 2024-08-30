<?php

namespace App\Services\Task;

use App\Base\ServiceBase;
use App\Repositories\Task\TaskRepositories;
use App\Responses\ServiceResponse;
use Illuminate\Support\Facades\Log;

class UpdateTaskService extends ServiceBase
{
    protected TaskRepositories $taskRepo;

    public function __construct(protected array $data, protected string $id)
    {
        $this->taskRepo = new TaskRepositories();
    }

    /**
     * main method of this service
     *
     * @return ServiceResponse
     */
    public function call(): ServiceResponse
    {
        try{
            $checkTask = $this->taskRepo->show($this->id);

            if(!$checkTask->original['data']) {
                return self::error(null, "Order tidak ditemukan");
            }

            $fillableFields = array_diff_key($this->data, ['id' => 0]);
            $data = $this->taskRepo->update_data($fillableFields, $this->id);

            return self::success($data->original['data']);

        }catch (\Throwable $th) {
            Log::error('UpdateTaskService', [
                'Message ' => $th->getMessage(),
                'On file ' => $th->getFile(),
                'On line ' => $th->getLine()
            ]);

            return self::error(null, $th->getMessage());
        }
    }
}
