<?php

namespace App\Services\Task;

use App\Base\ServiceBase;
use App\Repositories\Task\TaskRepositories;
use App\Responses\ServiceResponse;
use Illuminate\Support\Facades\Log;

class DeleteTaskService extends ServiceBase
{
    protected TaskRepositories $taskRepo;

    public function __construct(protected string $id)
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
            $data = $this->taskRepo->show($this->id);

            if(!$data->original['data']) {
                return self::error(null, "Data tidak ditemukan");
            }

            $data = $this->taskRepo->delete($this->id);

            return self::success($data->original['data'], 'Data berhasil dihapus');

        }catch (\Throwable $th) {
            Log::error('DeleteTaskService', [
                'Message ' => $th->getMessage(),
                'On file ' => $th->getFile(),
                'On line ' => $th->getLine()
            ]);

            return self::error(null, $th->getMessage());
        }
    }
}

