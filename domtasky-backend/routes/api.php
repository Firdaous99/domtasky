<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\SubtaskController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\TimeLogController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceItemController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\GitHubIntegrationController;

// Authentication Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'user']);
Route::post('/password/forgot', [AuthController::class, 'forgotPassword']);
Route::post('/password/reset', [AuthController::class, 'resetPassword']);

// Protected routes (needs authentication)
Route::middleware(['auth:sanctum'])->group(function () {

    // Users
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
    Route::get('/roles', [UserController::class, 'roles']);
    Route::post('/users/{id}/roles', [UserController::class, 'assignRole']);

    // Teams
    Route::apiResource('teams', TeamController::class);

    // Projects
    Route::apiResource('projects', ProjectController::class);

    // Tasks
    Route::apiResource('tasks', TaskController::class);
    Route::post('/tasks/{id}/assign', [TaskController::class, 'assign']);
    Route::post('/tasks/{id}/log-time', [TaskController::class, 'logTime']);
    Route::post('/tasks/{id}/attachments', [AttachmentController::class, 'store']);
    Route::get('/tasks/{id}/activity', [CommentController::class, 'activity']);

    // Subtasks
    Route::apiResource('subtasks', SubtaskController::class);

    // Comments
    Route::apiResource('comments', CommentController::class);

    // Attachments
    Route::apiResource('attachments', AttachmentController::class)->only(['store', 'destroy']);

    // Time Logs
    Route::apiResource('time-logs', TimeLogController::class);

    // Invoices
    Route::apiResource('invoices', InvoiceController::class);

    // Invoice Items
    Route::apiResource('invoice-items', InvoiceItemController::class);

    // Settings
    Route::apiResource('settings', SettingController::class);

    // GitHub Integration
    Route::post('/tasks/{id}/github/branch', [GitHubIntegrationController::class, 'createBranch']);
    Route::get('/tasks/{id}/github/branch', [GitHubIntegrationController::class, 'getBranch']);
    Route::post('/tasks/{id}/github/pull-request', [GitHubIntegrationController::class, 'createPullRequest']);
    Route::get('/tasks/{id}/github/pr-status', [GitHubIntegrationController::class, 'prStatus']);
});
