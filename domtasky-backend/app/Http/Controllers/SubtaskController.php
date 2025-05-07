<?php

namespace App\Http\Controllers;

use App\Models\Subtask;
use Illuminate\Http\Request;

class SubtaskController extends Controller
{
    public function index()
    {
        return Subtask::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'title' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

        $subtask = Subtask::create($request->all());

        return response()->json($subtask, 201);
    }

    public function show($id)
    {
        return Subtask::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $subtask = Subtask::findOrFail($id);
        $subtask->update($request->all());

        return response()->json($subtask, 200);
    }

    public function destroy($id)
    {
        $subtask = Subtask::findOrFail($id);
        $subtask->delete();

        return response()->json(null, 204);
    }
}
