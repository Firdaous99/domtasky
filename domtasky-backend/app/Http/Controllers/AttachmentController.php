<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    public function index()
    {
        return Attachment::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'file' => 'required|file|mimes:jpg,png,pdf,doc,docx,zip|max:10240',
        ]);

        $path = $request->file('file')->store('attachments');

        $attachment = Attachment::create([
            'task_id' => $request->task_id,
            'file_path' => $path,
            'uploaded_by' => auth()->id(),
        ]);

        return response()->json($attachment, 201);
    }

    public function show($id)
    {
        return Attachment::findOrFail($id);
    }

    public function destroy($id)
    {
        $attachment = Attachment::findOrFail($id);
        Storage::delete($attachment->file_path);
        $attachment->delete();

        return response()->json(null, 204);
    }
}
