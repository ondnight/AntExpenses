<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ticket;
use App\Models\Tipogasto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {

        
        //consultamos en la bbdd tickets del usuario
        $listadoTickets = Ticket::where('user_id', '=', $user->id)
        ->where('estado','=','Pendiente')
        ->get();

        return view(
            'tickets.index',
            [
                'user' => $user,
                'listadoTickets' => $listadoTickets
            ]
        );
    }

    public function create()
    {
        //pasamos los tipos de gastos de la tabla tipogastos
        $tipogasto = Tipogasto::all();

        return view('tickets.create', [
            'tipogasto' => $tipogasto
        ]);

    }

    public function edit($id)
    { 

        $ticketSeleccionado = Ticket::find($id);

        $tipogasto = TipoGasto::all();

        return view('tickets.edit',['ticketSeleccionado' => $ticketSeleccionado, 'tipogasto' =>$tipogasto]);
    }

    public function store(Request $request, User $user)
    {

        $this->validate($request, [
            'nombre' => ['required', 'max:255'],
            'fecha' => ['required'],
            'tipoGasto' => ['required'],
            'foto' => ['required'],
            'importe' => ['required']
        ]);

        //guardamos la imagen en public/uploads
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $file_path = 'uploads/';
            $filename = time() . '-' . $file->getClientOriginalName(); //con time evitamos que se repita el nombre
            $uploadSuccess = $file->move($file_path, $filename); //movemos el fichero a la carpeta de destino y con el nombre que le hemos creado
        }
        

        Ticket::create([
            'nombre' => $request->nombre,
            'fecha' => $request->fecha,
            'tipogastos_id' => $request->tipoGasto,
            'foto' => $filename,
            // en la bbdd guardamos el nombre de la imagen. El fichero no se guarda en la bbdd
            'user_id' => auth()->user()->id,
            'importe' => $request->importe,
            'estado' => 'Pendiente'

        ]);

       session()->flash('mensaje','¡Ticket creado correctamente!');

        return redirect()->route('tickets.index',['user' =>auth()->user()->usuario]);

    }

    public function update(Request $request, User $user, $id)
    {

        $this->validate($request, [
            'nombre' => ['required', 'max:255'],
            'fecha' => ['required'],
            'tipoGasto' => ['required'],
            'foto' => ['required'],
            'importe' => ['required']
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $file_path = 'uploads/';
            $filename = time() . '-' . $file->getClientOriginalName(); //con time evitamos que se repita el nombre
            $uploadSuccess = $file->move($file_path, $filename); //movemos el fichero a la carpeta de destino y con el nombre que le hemos creado
        }

        $ticket = Ticket::find($id);

        //borramos la foto antigua, antes de subir la nueva

        $ticketDeleted = 'uploads/'.$ticket->foto;

        unlink($ticketDeleted);
        

        $ticket->nombre = $request->nombre;
        $ticket->fecha = $request->fecha;
        $ticket->tipogastos_id = $request->tipoGasto;
        $ticket->foto = $filename;
        $ticket->importe = $request->importe;
        $ticket->save();

        
        
        session()->flash('mensaje','¡Ticket actualizado correctamente!');


        return redirect()->route('tickets.index',['user' =>auth()->user()->usuario]);

    }

    public function destroy($id)
    {
        $ticket = Ticket::find($id);

        //borramos la foto

        $ticketDeleted = 'uploads/'.$ticket->foto;

        unlink($ticketDeleted);

        //borramos el registro completo en la bbdd

        $ticket->delete();

        session()->flash('mensaje','¡Ticket eliminado correctamente!');

        return redirect()->route('tickets.index',['user' =>auth()->user()->usuario]);

    }

    public function informed(User $user)
    {
        $listadoTickets = Ticket::where('estado','=','Informado')
                                    ->where('user_id','=',$user->id)
                                    ->get();

        
        return view(
            'tickets.informed',
            [
                'user' => $user,
                'listadoTickets' => $listadoTickets
            ]
        );


    }
}