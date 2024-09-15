<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Filters\TasksFilter;
use Illuminate\Http\Request;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TaskCollection;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{

    public function index(Request $request)
    {
        $filter = new TasksFilter();
        $queryItems = $filter->transform($request);
        $includeCategories = $request->query('includeCategories');
        $tasks = Task::where($queryItems);
        if($includeCategories){
            $tasks = $tasks->with('category');
        }
        return new TaskCollection($tasks->paginate(10)->appends($request->query()));
    }


    public function store(StoreTaskRequest $request)
    {
        $task = Task::create($request->all());
        return response()->json([
            'message' => 'Task creado correctamente',
            'status' => 201,
            'data' =>TaskResource::make($task),
        ], 201);
    }


    public function show(Task $task)
    {

        $includeRelations = request()->query('includeRelations');

        if($includeRelations){
            return new TaskResource($task->loadMissing('category','user'));
        }
        return response()->json([
            'message' => 'Task encontrada correctamente',
            'status' => 200,
            'data' =>TaskResource::make($task),
        ], 200);

    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->all());
        return response()->json([
            'message' => 'Task actualizada correctamente',
            'status' => 200,
            'data' =>TaskResource::make($task),
        ], 200);
    }
    public function destroy(Task $task)
    {

        $task->delete();
        return response()->json([
            'message' => 'Task eliminada correctamente',
            'status' => 200,
            'data' =>TaskResource::make($task),
        ], 200);

    }
}
