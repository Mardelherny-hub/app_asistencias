<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    use HasFactory;

    /**
     * Campos asignables en la base de datos.
     */
    protected $fillable = [
        'name',
        'email',
        'bio',
        'photo',

    ];

    /**
     * Relación: Un speaker puede tener muchas charlas.
     */
    public function talks()
    {
        return $this->hasMany(Talk::class);
    }
}
