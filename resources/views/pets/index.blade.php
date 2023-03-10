 @extends('layout')

 @section('content')
     <h3 class="text-center">Mascotas</h3>

     <form action="{{ route('pets.create') }}" method="GET">
         <button type="submit" class="btn btn-success">Nueva mascota</button>
     </form>

     @if ($errors->any())
         <div class="alert alert-danger mt-3">
             <ul>
                 @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                 @endforeach
             </ul>
         </div>
     @endif

     <table class="table">
         <thead>
             <tr>
                 <th scope="col">Nombre</th>
                 <th scope="col">Tipo</th>
                 <th scope="col">Cliente</th>
                 <th scope="col">Acciones</th>
             </tr>
         </thead>
         <tbody>


             @foreach ($mascotas as $mascota)
                 <tr>
                     <td>{{ $mascota->nombre }}</td>
                     <td>{{ $mascota->tipo }}</td>
                     <td>Nombre: {{ $mascota->customer->nombres }} {{ $mascota->customer->apellidos }} - CC:
                         {{ $mascota->customer->cedula }}</td>
                     <td>

                         <form class="form--inline" method="GET"
                             action="{{ route('appointments.create', ['mascota' => $mascota->id]) }}">
                             <button type="submit" class="btn btn-info btn-sm">Asignar cita</button>
                         </form>

                         <form class="form--inline" method="GET"
                             action="{{ route('pets.edit', ['id' => $mascota->id]) }}">
                             <button type="submit" class="btn btn-primary btn-sm">Editar</button>
                         </form>

                         <form class="form--inline" method="POST"
                             action="{{ route('pets.destroy', ['id' => $mascota->id]) }}">
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
