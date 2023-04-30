<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class PerfilController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {

        return view('perfil.index', [
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {

        //Validaciones en el formulario

        $this->validate($request, [
            'nombre' => ['required', 'min:2', 'max:20'],
            //campo requerido y minimo 5 caracteres. En la vista, llamamos al mensaje con {{$message}}
            'apellidos' => ['required', 'min:2', 'max:40'],
            'usuario' => ['required', 'unique:users,usuario,' . auth()->user()->id, 'min:3', 'max:20'],
            // debe ser único en la tabla users
            'email' => ['required', 'unique:users,email,' . auth()->user()->id, 'email', 'max:60'],
            // con el campo email obligamos a que sea un email lo que introduce el usuario
        ]);

        $usuario = User::find(auth()->user()->id);

        $usuario->nombre = $request->nombre;
        $usuario->apellidos = $request->apellidos;
        $usuario->usuario = $request->usuario;
        $usuario->email = $request->email;


        $usuario->save();


        return redirect()->route('posts.index', ['user' => auth()->user()->usuario]);
    }

    public function changePassword(User $user)
    {
        return view('perfil.changepass', [
            'user' => $user
        ]);
    }

    public function updatePassword(Request $request)
    {

        $usuario = auth()->user();
        //controlamos si el usuario ha introducido su anterior password correctamente
        if (Hash::check($request->oldPassword, $usuario->password)) {
            // validaciones del formulario
            $this->validate($request, [
                'oldPassword' => ['required'],
                'newPassword' => ['required', 'min:6'],
                'password_confirmation' => ['required', 'min:6']

            ]);
            //protegemos el usuario en la bbdd para que no se pueda ver
            $nuevoPassword = Hash::make($request->newPassword);

            $usuario->password = $nuevoPassword;

            $usuario->save();

            session()->flash('mensaje', '¡Contraseña modificada Correctamente!');

            return redirect()->route('posts.index', ['user' => auth()->user()->usuario]);
        } else {
            session()->flash('mensajeError', '¡La contraseña anterior no coincide!');
            return redirect()->route('perfil.changePassword', ['user' => auth()->user()->usuario]);
        }

    }

}