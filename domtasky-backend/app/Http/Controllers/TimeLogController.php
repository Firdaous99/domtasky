<?php

namespace App\Http\Controllers;

use App\Models\TimeLog;
use App\Models\Task;
use Illuminate\Http\Request;

class TimeLogController extends Controller
{
    public function index()
    {
        return TimeLog::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'user_id' => 'required|exists:users,id',
            'duration' => 'required|numeric|min:1',
            'date' => 'required|date',
        ]);

        $timeLog = TimeLog::create($request->all());

        return response()->json($timeLog, 201);
    }

    public function show($id)
    {
        return TimeLog::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $timeLog = TimeLog::findOrFail($id);
        $timeLog->update($request->all());

        return response()->json($timeLog, 200);
    }

    public function destroy($id)
    {
        $timeLog = TimeLog::findOrFail($id);
        $timeLog->delete();

        return response()->json(null, 204);
    }
}
