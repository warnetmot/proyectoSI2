<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $primaryKey = 'id_venta';
    protected $fillable = [
        'id_cliente',
        'fecha_venta' => 'datetime',
        'total',
        'metodo_pago'
    ];
    
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }
}