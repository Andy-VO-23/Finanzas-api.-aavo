<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'user_id',
    'categoria_id',
    'subcategoria_id',
    'fecha',
    'descripcion',
    'monto',
    'notas',
])]
class Egreso extends Model
{
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'fecha' => 'date',
            'monto' => 'decimal:2',
        ];
    }

    /**
     * Get the user who owns the expense.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category of the expense.
     */
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    /**
     * Get the subcategory of the expense.
     */
    public function subcategoria(): BelongsTo
    {
        return $this->belongsTo(Subcategoria::class);
    }

    /**
     * Scope the expenses to a specific year and month.
     */
    public function scopeDelMes(Builder $query, int $anio, int $mes): Builder
    {
        return $query
            ->whereYear('fecha', $anio)
            ->whereMonth('fecha', $mes);
    }
}
