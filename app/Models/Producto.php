<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio_unitario',
        'stock',
        'categoria'
    ];

    public function detalles()
    {
        return $this->hasMany(DetalleCompra::class, 'id_producto');
    }
    public function compras()
    {
        return $this->hasMany(Compra::class, 'id_producto');
    }
}
