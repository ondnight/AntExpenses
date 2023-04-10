<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //creamos el constructor y pasamos el método middleware al auth. Con eso revisamos que el usuario este autenticado
    //antes de mostrar el index
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
                  
        return view('layouts.dashboard',[
            'user' => $user //le pasamos a la vista la variable usuario para poder visitar el muro de otro usuario que no haya hecho login
            // en la vista dashboard pasaremos este valor
       ]);
    }


    
}
