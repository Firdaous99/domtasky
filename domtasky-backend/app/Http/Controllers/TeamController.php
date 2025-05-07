<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::all();
        return response()->json($teams, 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tenant_id' => 'required|exists:tenants,id',
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $team = Team::create([
            'tenant_id' => $request->tenant_id,
            'name' => $request->name,
        ]);

        return response()->json($team, 201);
    }

    public function addUserToTeam(Request $request, $teamId)
    {
        $team = Team::findOrFail($teamId);
        $user = User::findOrFail($request->user_id);

        $team->users()->attach($user);

        return response()->json($team, 200);
    }
}
