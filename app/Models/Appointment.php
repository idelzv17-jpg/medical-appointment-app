<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    public const STATUS_SCHEDULED = 1;

    public const STATUS_COMPLETED = 2;

    public const STATUS_CANCELLED = 3;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'date',
        'start_time',
        'end_time',
        'duration',
        'reason',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'status' => 'integer',
        ];
    }

    public static function statusLabels(): array
    {
        return [
            self::STATUS_SCHEDULED => 'Programada',
            self::STATUS_COMPLETED => 'Completada',
            self::STATUS_CANCELLED => 'Cancelada',
        ];
    }

    public function getStatusLabelAttribute(): string
    {
        return self::statusLabels()[$this->status] ?? 'Desconocido';
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function consultation()
    {
        return $this->hasOne(Consultation::class);
    }
}
