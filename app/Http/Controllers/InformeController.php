<?php

namespace App\Http\Controllers;

use App\Models\detalleInforme;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Informe;
use Illuminate\Http\Request;

class InformeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        
        $listadoInformes = Informe::where('user_id', '=', $user->id)->get();


        return view(
            'informes.index',
            [
                'user' => $user,
                'listadoInformes' => $listadoInformes,
                
            ]
        );
    }

    public function create(User $user)
    {    
        return view('informes.create');    
    }

    public function addTickets(User $user, $id)
    {
        
        $listadoTickets = Ticket::where('user_id','=',$user->id)
                                  ->where('estado','=','Pendiente')
                                  ->get();
        

        return view('informes.addticket',[
            'user' => $user,
            'listadoTickets' => $listadoTickets,
            'informe' => $id
                       
        ]);       

    }

    public function quitarTickets(User $user, $id)
    {
        $listadoTickets = detalleInforme::where('informes_id','=',$id)->get();
        

        return view('informes.quitarticket',[
            'user' => $user,
            'listadoTickets' => $listadoTickets,
            'informe' => $id
                       
        ]);       
    }

    public function store(Request $request)
    {
        
        $this->validate($request, [
            'nombre' => ['required', 'max:255'],
            'fecha' => ['required'],
        ]);

        Informe::create([
            'nombre' => $request->nombre,
            'fecha' =>$request->fecha,
            'user_id' => auth()->user()->id,
            'estado' => 'Pendiente',
            'importe' => 0
        ]);

        session()->flash('mensaje','Informe creado correctamente!');

        return redirect()->route('informes.index',['user' =>auth()->user()->usuario]);
        
    }

    public function edit($id)
    {
        $informeSeleccionado = Informe::find($id);
        $listadoTickets = detalleInforme::where('informes_id','=',$id)->get();
        
        
        return view('informes.edit',
            [
                'informeSeleccionado' => $informeSeleccionado,
                'listadoTickets' => $listadoTickets
            ]
        );
    }

    public function sent(User $user)
    {
        $listadoInformesEnviados = Informe::where('estado', '=', 'enviado')->get();

        return view(
            'informes.sent',
            [
                'user' => $user,
                'listadoInformesEnviados' => $listadoInformesEnviados
            ]
        );
    }

    public function destroy($id)
    {
        $informeSeleccionado = Informe::find($id);

        if($informeSeleccionado->importe>=0)
        {
            session()->flash('mensajeError','¡Antes de eliminar el informe, debe quitar los tickets del informe!'); 
            return redirect()->route('informes.index',['user' =>auth()->user()->usuario]);
        }
        else
        {
            $informeSeleccionado->delete();

            session()->flash('mensaje','Informe eliminado correctamente!');
            return redirect()->route('informes.index',['user' =>auth()->user()->usuario]);
            
        }      
    }


    public function update($id)
    {

    }

    public function sendReport($id)
    {

    }



}