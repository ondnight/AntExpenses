<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ticket;
use App\Models\Informe;
use Illuminate\Http\Request;
use App\Models\detalleInforme;

class Detalle_InformeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addTicket(Request $request, User $user, $informe)
    {
       
        $this->validate($request, [
            'tickets' => ['required'],
           
        ]);

        $selected = $request->input('tickets'); // desde la vista nos llega un array tickets[] en el name del input tipo checkbox
        
       
        //recorremos el array $selected y guardamos cada id del ticket en la variable $ticket. Por cada uno, guardamos en bbdd
        foreach($selected as $ticket)
        {
            $ticketSeleccionado = Ticket::find($ticket);
            $ticketSeleccionado->estado = 'Informado';
            $ticketSeleccionado->save();
            detalleInforme::create([
                'user_id' => $user->id,
                'informes_id' => $informe,
                'tickets_id' => $ticket,
                'importe' => $ticketSeleccionado->importe
            ]);

        }
        

        $informeSeleccionado = Informe::find($informe);

        $informeSeleccionado->importe = detalleInforme::where('informes_id','=',$informe)->sum('importe');

        $informeSeleccionado->save();

        session()->flash('mensaje','Tickets agregados correctamente!');

        return redirect()->route('informes.index',['user' =>auth()->user()->usuario]);
    }

    public function quitarTicket(Request $request, User $user, $informe)
    {

        $this->validate($request, [
            'tickets' => ['required'],
           
        ]);
        
        $selected = $request->input('tickets'); // desde la vista nos llega un array tickets[] en el name del input tipo checkbox
        
        //recorremos el array $selected y guardamos cada id del ticket en la variable $ticket. Por cada uno, guardamos en bbdd
        foreach($selected as $ticket)
        {

            $ticketSeleccionado = detalleInforme::find($ticket);
            $ticketSeleccionado->ticket->estado = 'Pendiente';
            $ticketSeleccionado->ticket->save();
            
            $ticketSeleccionado->delete();
            
        }
        

        $informeSeleccionado = Informe::find($informe);

        $informeSeleccionado->importe = detalleInforme::where('informes_id','=',$informe)->sum('importe');

        $informeSeleccionado->save();

        session()->flash('mensaje','Tickets quitados correctamente!');

        return redirect()->route('informes.index',['user' =>auth()->user()->usuario]);

    }


}
