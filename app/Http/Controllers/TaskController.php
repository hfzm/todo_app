<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function getTasks()
    {
        return response()->json(Task::latest()->get());
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
}
