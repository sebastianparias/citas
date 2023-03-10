 @extends('layout')

 @section('content')

     <h3 class="text-center">Citas</h3>

     <div class="d-flex justify-content-between">
         <div>
             <form action="{{ route('appointments.create') }}" method="GET">
                 <button type="submit" class="btn btn-success">Nueva cita</button>
             </form>
         </div>

         <div>
             <form action="{{ route('appointments.index') }}" method="GET">
                 <input type="date" name="fecha" value="{{ old('fecha') }}
                     style="border-radius:
                     0.3rem; padding: 0.3rem;">
                 <button type="submit" class="btn btn-info">Filtrar citas por fecha</button>
             </form>
         </div>
     </div>

     <div class="alert alert-info mt-3" role="alert">
         <a href="{{ route('pets.index') }}">
             También puede asignar una cita a una mascota buscando una de la lista <strong>aquí</strong> y haciendo clic en
             el botón "Asignar cita"
         </a>
     </div>

     <table class="table">
         <thead>
             <tr>
                 <th scope="col">Inicio</th>
                 <th scope="col">Fin</th>
                 <th scope="col">Cliente</th>
                 <th scope="col">Mascota</th>
                 <th scope="col">Fecha reserva</th>
                 <th scope="col">Acciones</th>
             </tr>
         </thead>
         <tbody>


             @foreach ($citas as $cita)
                 <tr>
                     <td>{{ $cita->inicio }}</td>
                     <td>{{ $cita->fin }}</td>
                     <td>{{ $cita->pet->customer->cedula }}: {{ $cita->pet->customer->nombres }}
                         {{ $cita->pet->customer->apellidos }}</td>
                     <td>{{ $cita->pet->id }}: {{ $cita->pet->nombre }}</td>

                     <td>{{ $cita->updated_at }}</td>

                     <td>
                         <form class="form--inline" method="GET"
                             action="{{ route('appointments.edit', ['id' => $cita->id]) }}">
                             <button type="submit" class="btn btn-primary btn-sm">Editar</button>
                         </form>

                         <form class="form--inline" method="POST"
                             action="{{ route('appointments.destroy', ['id' => $cita->id]) }}">
                             @csrf
                             @method('DELETE')
                             <button class="btn btn-danger btn-sm">Borrar</button>
                         </form>
                     </td>
                 </tr>
             @endforeach



         </tbody>
     </table>
 @endsection
