<?php

namespace App\Services\Task;

use App\Base\ServiceBase;
use App\Repositories\Task\TaskRepositories;
use App\Responses\ServiceResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CreateTaskService extends ServiceBase
{
    protected TaskRepositories $taskRepo;

    public function __construct(protected array $data)
    {
        $this->taskRepo = new TaskRepositories();
    }

    protected function validate(): \Illuminate\Contracts\Validation\Validator {
        return Validator::make($this->data, [
            "task_name" => "required",
        ]);
    }

    /**
     * main method of this service
     *
     * @return ServiceResponse
     */
    public function call(): ServiceResponse {
        if ($this->validate()->fails()) {
            return self::error(null, implode(',',$this->validate()->errors()->all()));
        }

        try{
            $data = $this->taskRepo->create($this->data);

            return self::success($data->original['data']);
        }catch (\Throwable $th) {
            Log::error('CreateTaskService', [
                'Message ' => $th->getMessage(),
                'On file ' => $th->getFile(),
                'On line ' => $th->getLine()
            ]);

            return self::error(null, $th->getMessage());
        }
    }

    private function createOrderCode($data): string
    {
        return "ORD-" . Carbon::now()->format('Ymd') . "-" . $data['user_id'] . "-" . $data['service_id'];
    }
}

