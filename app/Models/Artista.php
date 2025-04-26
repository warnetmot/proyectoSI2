<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artista extends Model
{
    use HasFactory;

    protected $table = 'artistas';

    protected $primaryKey = 'id_artista';
    
    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'apellido',
        'especialidad',
        'email',
        'telefono',
        'estado'
    ];

    protected $casts = [
        'estado' => 'boolean'
    ];
}