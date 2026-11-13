<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class Aprendiz extends Model
{
    use HasFactory;

    protected $table = 'aprendices';

    protected $fillable = [
        'nombre',
        'documento',
        'correo',
        'ficha_id',
    ];

    public function scopeFilter(Builder $query, ?string $term, string $field = 'todos'): Builder
    {
        $term = trim((string) $term);

        if ($term === '') {
            return $query;
        }

        $columns = match ($field) {
            'todos' => ['nombre', 'documento', 'correo'],
            'nombre', 'documento', 'correo' => [$field],
            default => throw new InvalidArgumentException('El campo de filtrado no es válido.'),
        };

        return $query->where(function (Builder $query) use ($columns, $term) {
            foreach ($columns as $index => $column) {
                $method = $index === 0 ? 'where' : 'orWhere';
                $query->{$method}($column, 'like', "%{$term}%");
            }
        });
    }
}