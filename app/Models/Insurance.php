<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    protected $fillable = [
        'name',
        'insurer_name',
        'agreement_code',
        'coverage_description',
        'coverage_percentage',
        'contact_phone',
        'contact_email',
        'is_active',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'coverage_percentage' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public function getStatusLabelAttribute(): string
    {
        return $this->is_active ? 'Activo' : 'Inactivo';
    }
}
