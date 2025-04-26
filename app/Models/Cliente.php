<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Cliente extends Model
{
    protected $table = 'clientes'; 

    protected $primaryKey = 'id_cliente'; 

    public $timestamps = true; 

    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'email',
        'telefono',
        'direccion',
        'fecha_registro',
    ];

    public function setDniAttribute($value)
    {
        $this->attributes['dni'] = Crypt::encryptString($value);
    }

    public function setDireccionAttribute($value)
    {
        $this->attributes['direccion'] = Crypt::encryptString($value);
    }

    public function getDniAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function getDireccionAttribute($value)
    {
        return Crypt::decryptString($value);
    }
}
