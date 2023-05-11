<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        //Validaciones en el formulario
        $this->validate($request,[
            'nombre' => ['required','min:2','max:20'], //campo requerido y minimo 5 caracteres. En la vista, llamamos al mensaje con {{$message}}
            'apellidos' => ['required','min:2','max:40'],
            'usuario' => ['required', 'unique:users','min:3','max:20'],  // debe ser único en la tabla users
            'email' => ['required','unique:users','email','max:60'], // con el campo email obligamos a que sea un email lo que introduce el usuario
            'password' => ['required','confirmed','min:6'] // con confirmed requiere confirmacion de password. En la vista, el name debe ser password_confirmation 
        
        ]);

        User::create([
            'nombre'=>$request->nombre,
            'apellidos'=>$request->apellidos,
            'usuario'=>Str::slug($request->usuario), //convierte el username a url, para quitar mayusculas, espacios...
            'email'=>$request->email,
            'password'=>Hash::make($request->password), // con la funcion hash protegemos el password en la bbdd
            'isadmin'=>'0'
        ]);

        //autenticacion de usuario
        auth()->attempt($request->only('email','password'));

        session()->flash('mensaje','¡Usuario Registrado Correctamente!');

        
        //comprobamos si el usuario es admin, redireccionamos al dashboard de admin
        if(auth()->user()->isadmin == 1){
            return redirect()->route('admin.index',['user' => auth()->user()->usuario]);
        }
        //sino al dashboard del empleado
        else{
            return redirect()->route('posts.index',['user' => auth()->user()->usuario]);
        }

        
    }

    
}
