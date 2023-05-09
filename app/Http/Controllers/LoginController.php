<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');

    }

    public function store(Request $request)
    {
        //pasamos un parámetro request, y validamos los campos en el formulario
        $this->validate($request,[

            'email' => ['required','email'],
            'password' => ['required'] 
        ]);

        //controlamos si los datos no son correctos, volvemos y mostramos el mensaje en la vista almacenado en un session
        if(!auth()->attempt($request->only('email','password'),$request->remember)){
            return back()->with('mensaje','Credenciales incorrectas');
        }

        session()->flash('mensaje','¡Login Correcto!');

        // si las credenciales son correctas redireccionamos al muro

        if(auth()->user()->usuario == 'luis'){
            return redirect()->route('admin.index',['user' => auth()->user()->usuario]);
        }
        else{
            return redirect()->route('posts.index',['user' => auth()->user()->usuario]);
        }

        
    }
}
