<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TenantController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'subdomain' => 'required|string|max:255|unique:tenants',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $tenant = Tenant::create([
            'name' => $request->name,
            'subdomain' => $request->subdomain,
        ]);

        return response()->json($tenant, 201);
    }

    public function getTenants()
    {
        $tenants = Tenant::all();
        return response()->json($tenants, 200);
    }
}
