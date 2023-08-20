<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reportar extends Model
{
    use HasFactory;
    protected $table = 'reportar';
    protected $fillable = [
        'asunto',
        'id_user',
        'descripcion',
        'img',
        'respuesta',
        'estado',
    ];
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];
 
}
