<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tenant_id',
        'name',
    ];

    /**
     * Relation avec les utilisateurs de l'équipe.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
