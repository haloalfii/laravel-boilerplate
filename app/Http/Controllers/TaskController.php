<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Services\Task\CreateTaskService;
use App\Services\Task\DeleteTaskService;
use App\Services\Task\DetailTaskService;
use App\Services\Task\ListTaskService;
use App\Services\Task\UpdateTaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $service = (new ListTaskService($data))->call();
        return response()->json($service, $service->httpCode());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $service = (new CreateTaskService($data))->call();

        return response()->json($service, $service->httpCode());
    }

    /**
     * Display the specified resource.
     */
    public function show($id): \Illuminate\Http\JsonResponse
    {
        $service = (new DetailTaskService($id))->call();
        return response()->json($service, $service->httpCode());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $service = (new UpdateTaskService($data, $id))->call();

        return response()->json($service, $service->httpCode());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $service = (new DeleteTaskService($id))->call();
        return response()->json($service, $service->httpCode());
    }
}
