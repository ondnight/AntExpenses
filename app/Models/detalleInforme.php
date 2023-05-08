<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalleInforme extends Model
{
    use HasFactory;

    protected $fillable = [
 
        'informes_id',
        'tickets_id',
        'importe',
   
    ];

    public function tickets()
    {
        return $this->belongsTo(Ticket::class,'tickets_id');
    }
    
  
}
