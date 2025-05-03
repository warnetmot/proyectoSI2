<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $table = 'compras';
    protected $primaryKey = 'id_compra';
    public $timestamps = true;

    protected $fillable = [
        'id_proveedor',
        'fecha_compra',
        'total'
    ];
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }

    public function detalles()
    {
        return $this->hasMany(DetalleCompra::class, 'id_compra');
    }
}
