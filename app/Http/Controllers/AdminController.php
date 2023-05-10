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

   public function listadoTickets(User $user, $informe)
   {
     $listadoTickets = detalleInforme::where('informes_id','=',$informe)->get();
        
   
        return view('admin.tickets',[
            'user' => $user,
            'listadoTickets' => $listadoTickets
         ]);

   }

   public function check()
   {
    return view('admin.check');
   }

   public function accept()
   {

   }

   public function reject()
   {

   }
}
