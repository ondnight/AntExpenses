<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function store()
    {
        //cierra sesión
        auth()->logout();
        
        //devuelve a la pagina de login
       return redirect()->route('login');
    }
}
