@extends('layout')
@section('content')
    <h3>{{ isset($cliente) ? 'Editar cliente' : 'Crear nuevo cliente' }}</h3>


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST"
        action="{{ isset($cliente) ? route('customers.update', ['id' => $cliente->id]) : route('customers.store') }}">

        @csrf
        @if (isset($cliente))
            @method('PUT')
        @endif
        <div class="mb-3">
            <label for="cedula" class="form-label">Documento de identidad</label>
            <input type="number" class="form-control" id="cedula" name="cedula"
                value="{{ old('cedula', isset($cliente) ? $cliente->cedula : '') }}">
        </div>

        <div class="mb-3">
            <label for="nombres" class="form-label">Nombres</label>
            <input type="text" class="form-control" id="nombres" name="nombres"
                value="{{ old('nombres', isset($cliente) ? $cliente->nombres : '') }}">
        </div>

        <div class="mb-3">
            <label for="apellidos" class="form-label">Apellidos</label>
            <input type="text" class="form-control" id="apellidos" name="apellidos"
                value="{{ old('apellidos', isset($cliente) ? $cliente->apellidos : '') }}">
        </div>

        <div class="mb-3">
            <label for="celular" class="form-label">Número de celular</label>
            <input type="number" class="form-control" id="celular" name="celular"
                value="{{ old('celular', isset($cliente) ? $cliente->celular : '') }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="email" name="email"
                value="{{ old('email', isset($cliente) ? $cliente->email : '') }}">
        </div>

        <button type="submit" class="btn btn-primary">
            {{ isset($cliente) ? 'Editar' : 'Crear' }}
        </button>
    </form>
@endsection
