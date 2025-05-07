<?php

namespace App\Http\Controllers;

use App\Models\GitHubIntegration;
use Illuminate\Http\Request;

class GitHubIntegrationController extends Controller
{
    public function index()
    {
        return GitHubIntegration::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'branch_name' => 'required|string|max:255',
            'pr_url' => 'nullable|url',
            'status' => 'required|string',
        ]);

        $githubIntegration = GitHubIntegration::create($request->all());

        return response()->json($githubIntegration, 201);
    }

    public function show($id)
    {
        return GitHubIntegration::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $githubIntegration = GitHubIntegration::findOrFail($id);
        $githubIntegration->update($request->all());

        return response()->json($githubIntegration, 200);
    }

    public function destroy($id)
    {
        $githubIntegration = GitHubIntegration::findOrFail($id);
        $githubIntegration->delete();

        return response()->json(null, 204);
    }
}
