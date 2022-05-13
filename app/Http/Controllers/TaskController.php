<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\SubTask;

class TaskController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth:api');
    }

    public function getTasks()
    {
        return response()->json(Task::latest()->with('sub_tasks')->get());
    }

    public function storeTask(Request $request)
    {
        Task::create([
            'title'         => $request->title,
            'date'          => $request->date,
            'time'          => $request->time,
            'detail'        => $request->detail,
        ]);

        return response()->json('Task stored successfully!');
    }

    public function updateTask(Request $request, $id)
    {
        Task::where('id', $id)->update([
            'title'         => $request->title,
            'date'          => $request->date,
            'time'          => $request->time,
            'detail'        => $request->detail,
        ]);

        return response()->json('Task updated successfully!');
    }
    
    public function deleteTask($id)
    {
        Task::where('id', $id)->delete();
        return response()->json('Task deleted successfully!');
    }

    public function storeSubTask(Request $request)
    {
        $subTasks = $request->all();

        foreach($subTasks as $subTask) {
            SubTask::create([
                'task_id'       => $subTask['task_id'],
                'title'         => $subTask['title'],
                'detail'        => $subTask['detail'],
                'start_date'    => $subTask['start_date'],
                'end_date'      => $subTask['end_date'],
            ]);
        }

        return response()->json('success');
    }

    public function updateSubTask(Request $request, $id)
    {
        $subTasks = $request->all();

        $task_id;

        foreach($subTasks as $subTask) {
            SubTask::where('id', $id)->update([
                'task_id'       => $subTask['task_id'],
                'title'         => $subTask['title'],
                'detail'        => $subTask['detail'],
                'start_date'    => $subTask['start_date'],
                'end_date'      => $subTask['end_date'],
            ]);

            $task_id = $subTask['task_id'];
        }

        $sub_tasks = SubTask::where('task_id', $task_id)->get();

        return response()->json($sub_tasks);
    }

    public function deleteSubTask($id)
    {
        $sub_task = SubTask::find($id);
        SubTask::where('id', $id)->delete();
        $sub_tasks = SubTask::where('task_id', $sub_task->task_id)->get();
        return response()->json($sub_tasks);
    }

    public function markAsComplete($id)
    {
        $sub_task = SubTask::find($id);
        SubTask::where('id', $id)->update([
            'status'    => 1,
        ]);
        $sub_tasks = SubTask::where('task_id', $sub_task->task_id)->get();
        return response()->json($sub_tasks);
    }

    public function markAsIncomplete($id)
    {
        $sub_task = SubTask::find($id);
        SubTask::where('id', $id)->update([
            'status'    => 0,
        ]);
        $sub_tasks = SubTask::where('task_id', $sub_task->task_id)->get();
        return response()->json($sub_tasks);
    }
}
