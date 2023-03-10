@extends('layout')
@section('content')
    <h3>{{ isset($cita) ? 'Editar cita' : 'Asignar nueva cita' }}</h3>

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
        action="{{ isset($cita) ? route('appointments.update', ['id' => $cita->id]) : route('appointments.store') }}">

        @csrf
        @if (isset($cita))
            @method('PUT')
        @endif


        <div class="mb-3">
            <label for="inicio" class="form-label">Fecha y hora de inicio</label>
            <input type="datetime-local" class="form-control" id="inicio" name="inicio"
                value="{{ old('inicio', isset($cita) ? $cita->inicio : '') }}">
        </div>

        <div class="mb-3">
            <label for="fin" class="form-label">Fecha y hora de fin</label>
            <input type="datetime-local" class="form-control" id="fin" name="fin"
                value="{{ old('fin', isset($cita) ? $cita->fin : '') }}">
        </div>


        <div class="mb-3">
            <label for="mascota_id" class="form-label">Mascota</label>
            <select name="mascota_id" id="mascota_id" class="form-control">
                <option></option>
                @foreach ($mascotas as $mascota)
                    <option value="{{ $mascota->id }}"
                        @if (isset($mascota_id)) {{ $mascota_id == $mascota->id ? 'selected' : '' }}>
                          @elseif (isset($cita))
                        {{ isset($cita) && $cita->mascota_id == $mascota->id ? 'selected' : '' }}> 
                        @else
                        {{ old('mascota_id') == $mascota->id ? 'selected' : '' }}> @endif
                        {{ $mascota->id }}: {{ $mascota->nombre }} </option>
                @endforeach

                </option>
            </select>
        </div>


        <button type="submit" class="btn btn-primary">
            {{ isset($cita) ? 'Editar' : 'Crear' }}
        </button>
    </form>
@endsection
