<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;

    protected $table = 'detalles_venta';
    protected $primaryKey = 'id_detalle';
    protected $fillable = [
        'id_venta',
        'id_producto',
        'cantidad',
        'precio_unitario'
    ];

    // Relación con venta
    // Relación con venta
public function venta()
{
    return $this->belongsTo(Venta::class, 'id_venta', 'id_venta');
}

// Relación con producto
public function producto()
{
    return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
}

    // Calcular subtotal
    public function getSubtotalAttribute()
    {
        return $this->cantidad * $this->precio_unitario;
    }
}
