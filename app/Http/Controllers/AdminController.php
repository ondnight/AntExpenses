<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ticket;
use App\Models\Informe;
use Illuminate\Http\Request;
use App\Models\detalleInforme;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        return view('admin.index',[
            'user' => $user
        ]);
    }

    public function informes(User $user)
    {
        return view('admin.informes',[
            'user' => $user
        ]);
    }

   public function pending(User $user)

   {
        $listadoInformes = Informe::where('revision','=','Pendiente de revisión')
                            ->orderBy('nombre')
                            ->get();

        return view('admin.pending',[
            'user' => $user,
            'listadoInformes' => $listadoInformes
        ]);
   }

   public function completed(User $user)
   {
    $listadoInformes = Informe::where('revision','!=','Pendiente de revisión')
                            ->orderBy('nombre')
                            ->get();
    
    return view('admin.completed',[
        'user' => $user,
        'listadoInformes' => $listadoInformes
    ]);
   }

   public function listadoTickets(User $user, $informe)
   {
     $listadoTickets = detalleInforme::where('informes_id','=',$informe)->get();
        
   
        return view('admin.tickets',[
            'user' => $user,
            'listadoTickets' => $listadoTickets
         ]);

   }

   public function check(User $user, $id)
   {

    $informe = Informe::find($id);

    return view('admin.check',[
        'user' => $user,
        'informe' => $informe
    ]);
   }

   public function update(Request $request, User $user, $id)
   {

    $this->validate($request, [
        'observaciones' => ['required'],
       
    ]);

    $informe = Informe::find($id);

    $selected = $request->input('radio');
    
    if($selected == 'accept'){

        $informe->observaciones = $request->observaciones;
        $informe->revision = 'Aceptado';
        $informe->save();

        session()->flash('mensaje','Informe guardado correctamente');
        return view('admin.informes',[
            'user' => $user
        ]);
       
    }
    else{
        $informe->observaciones = $request->observaciones;
        $informe->revision = 'Rechazado';
        $informe->estado = 'Pendiente';
        $informe->save();

        session()->flash('mensaje','Informe guardado correctamente');
        return view('admin.informes',[
            'user' => $user
        ]);
    }
    

    


   }

 
}
