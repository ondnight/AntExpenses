@extends('layouts.admin')

@section('titule')
<div>
    Administrador: {{ $user->nombre . ' ' . $user->apellidos }}
</div>
@endsection