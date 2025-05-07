<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceItem extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'invoice_id',
        'task_id',
        'description',
        'hours',
        'rate',
    ];

    /**
     * Relation avec la facture.
     */
    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    /**
     * Relation avec la tâche.
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
