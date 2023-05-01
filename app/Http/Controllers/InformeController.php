<?php

namespace App\Http\Controllers;

use App\Models\User;
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
                'listadoInformes' => $listadoInformes
            ]
        );
    }

    public function create()
    {
        return view('informes.create');
    }

    public function store()
    {
        return view('informes.index');
    }

    public function edit($id)
    {
        $informeSeleccionado = Informe::find($id);
        return view(
            'informes.edit',
            [
                'informeSeleccionado' => $informeSeleccionado
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
}