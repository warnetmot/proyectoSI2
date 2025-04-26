<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'reservas';
    protected $primaryKey = 'id_reserva';
    public $timestamps = true;

    protected $fillable = [
        'id_cliente',
        'id_artista',
        'fecha_reserva',
        'hora_reserva',
        'estado'
    ];

    protected $casts = [
        'fecha_reserva' => 'date'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function artista()
    {
        return $this->belongsTo(Artista::class, 'id_artista');
    }
}