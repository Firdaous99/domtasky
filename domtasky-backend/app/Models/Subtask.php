<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subtask extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'task_id',
        'title',
        'status',
    ];

    /**
     * Relation avec la tâche principale.
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
