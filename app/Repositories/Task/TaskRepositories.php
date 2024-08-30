<?php

namespace App\Repositories\Task;

use App\Models\Task;

class TaskRepositories
{
    public function list($data): \Illuminate\Http\JsonResponse
    {
        $limit = $data['limit'] ?? 10;

        $task = Task::query();
        if(isset($data['search'])){
            $task = $task->where('task_name', 'like', '%' . $data['search'] . '%');
        }

        if(isset($data['task_status'])){
            $task = $task->where('task_status', $data['task_status']);
        }

        $task = $task->paginate($limit);
        return response()->json([
            'data' => $task
        ]);
    }

    public function create($data): \Illuminate\Http\JsonResponse
    {
        $task = Task::create($data);
        return response()->json([
            'data' => $task
        ]);
    }

    public function show($id): \Illuminate\Http\JsonResponse
    {
        $data = Task::find($id);
        return response()->json([
            'data' => $data
        ]);
    }

    public function update_data($data, $id): \Illuminate\Http\JsonResponse
    {
        $task = Task::find($id);
        $task->update($data);
        return response()->json([
            'data' => $task
        ]);
    }

    public function delete($id): \Illuminate\Http\JsonResponse
    {
        $task = Task::find($id)->delete();
        return response()->json([
            'data' => $task
        ]);
    }
}
