<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GitHubIntegration extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'task_id',
        'branch_name',
        'pr_url',
        'status',
    ];

    /**
     * Relation avec la tâche.
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
