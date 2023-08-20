<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta_detalle extends Model
{
    use HasFactory;
    protected $table = 'venta-detalle';
    protected $fillable = [
        'id_venta',
        'id_menu',
        'precio',
        'cantidad',
        'total',
        'descripcion', 
    ];
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];
}
