<?php

namespace App\Models;

use App\Models\Tipogasto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'fecha',
        'tipogastos_id',
        'user_id',
        'foto',
        'importe',
        'estado'
    ];

    public function tipoGasto()
    {
        //relacion de tabla ticket y tipo de gastos
        return $this->belongsTo(Tipogasto::class, 'tipogastos_id');
    }

    public function detalleInformes()
    {
        return $this->hasMany(detalleInforme::class, 'id_tickets');
    }

    

    

}