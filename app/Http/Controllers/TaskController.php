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
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new TasksFilter();
        $queryItems = $filter->transform($request);
        // dd($queryItems);
        $includeCategories = $request->query('includeCategories');
        $tasks = Task::where($queryItems);
        if($includeCategories){
            $tasks = $tasks->with('category');
        }
        return new TaskCollection($tasks->paginate(10)->appends($request->query()));
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
    public function store(StoreTaskRequest $request)
    {
        return new TaskResource(Task::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $includeRelations = request()->query('includeRelations');
        if($includeRelations){
            return new TaskResource($task->loadMissing('category','user'));

        }
        return new TaskResource($task);

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
    public function update(UpdateTaskRequest $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
