<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informe extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'fecha',
        'estado',
        'user_id',
        'importe',
        'revision',
        'observaciones'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detalleInforme()
    {
        return $this->belongsTo(detalleInforme::class);
    }

    
}
