@extends('layout')
@section('content')
    <h3>{{ isset($mascota) ? 'Editar mascota' : 'Crear nueva mascota' }}</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ isset($mascota) ? route('pets.update', ['id' => $mascota->id]) : route('pets.store') }}">

        @csrf
        @if (isset($mascota))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre"
                value="{{ isset($mascota) ? $mascota->nombre : old('nombre') }}">
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select name="tipo" id="tipo" class="form-control" value="">
                <option></option>
                <option value="perro" {{ isset($mascota) && $mascota->tipo == 'perro' ? 'selected' : '' }}>Perro</option>
                <option value="gato" {{ isset($mascota) && $mascota->tipo == 'gato' ? 'selected' : '' }}>Gato</option>
                <option value="conejo" {{ isset($mascota) && $mascota->tipo == 'conejo' ? 'selected' : '' }}>Conejo</option>
                <option value="caballo" {{ isset($mascota) && $mascota->tipo == 'caballo' ? 'selected' : '' }}>Caballo
                </option>
            </select>
        </div>

        <div class="mb-3">
            <label for="cliente_id" class="form-label">Cliente</label>
            <select name="cliente_id" id="cliente_id" class="form-control">
                <option></option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}"
                        {{ isset($mascota) && $mascota->customer->id == $cliente->id ? 'selected' : '' }}>
                        {{ $cliente->cedula }} - {{ $cliente->nombres }} {{ $cliente->apellidos }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">
            {{ isset($mascota) ? 'Editar' : 'Crear' }}
        </button>
    </form>
@endsection
