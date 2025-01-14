<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Event extends Model {

    protected $fillable = [
        'name', 
        'description', 
        'start_date',
        'end_date', 
        'location', 
        'type',
        'user_id'
    ];



   // Relaciones
    public function organizer() {
        return $this->belongsTo(User::class, 'user_id');
    }
    // Relacion de event con talks
    public function talks() {
        return $this->hasMany(Talk::class);
    }

    /**
     * Obtiene el estado del evento basado en fechas
     *
     * @return string
     */
    public function getStatusClass(): string
    {
        return match(true) {
            $this->isUpcoming() => 'badge-primary',
            $this->isOngoing() => 'badge-success',
            $this->isPast() => 'badge-secondary',
            default => 'badge-warning'
        };
    }

    /**
     * Obtiene texto descriptivo del estado
     *
     * @return string
     */
    public function getStatus(): string
    {
        return match(true) {
            $this->isUpcoming() => 'Próximo',
            $this->isOngoing() => 'En curso', 
            $this->isPast() => 'Finalizado',
            default => 'Sin definir'
        };
    }

    /**
     * Verifica si el evento está próximo
     *
     * @return bool
     */
    public function isUpcoming(): bool
    {
        return Carbon::parse($this->start_date)->isFuture();
    }

    /**
     * Verifica si el evento está en curso
     *
     * @return bool
     */
    public function isOngoing(): bool
    {
        $now = Carbon::now();
        $start = Carbon::parse($this->start_date);
        $end = Carbon::parse($this->end_date);

        return $now->between($start, $end);
    }

    /**
     * Verifica si el evento ha pasado
     *
     * @return bool
     */
    public function isPast(): bool
    {
        return Carbon::parse($this->end_date)->isPast();
    }

    /**
     * Formatea rango de fechas del evento
     *
     * @return string
     */
    public function formatDateRange(): string
    {
        $start = Carbon::parse($this->start_date);
        $end = Carbon::parse($this->end_date);

        if ($start->isSameDay($end)) {
            return $start->format('d/m/Y H:i');
        }

        return "{$start->format('d/m/Y H:i')} - {$end->format('d/m/Y H:i')}";
    }

    /**
     * Color de estado para interfaz
     *
     * @return string
     */
    public function getStatusColor(): string
    {
        return match(true) {
            $this->isUpcoming() => 'text-primary',
            $this->isOngoing() => 'text-success',
            $this->isPast() => 'text-muted',
            default => 'text-warning'
        };
    }
}