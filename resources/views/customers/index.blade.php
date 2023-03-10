 @extends('layout')

 @section('content')
     <h3 class="text-center">Clientes</h3>

     <form action="{{ route('customers.create') }}" method="GET">
         <button type="submit" class="btn btn-success">Nuevo cliente</button>
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
                 <th scope="col">Documento de identidad</th>
                 <th scope="col">Nombres</th>
                 <th scope="col">Apellidos</th>
                 <th scope="col">Celular</th>
                 <th scope="col">Email</th>
                 <th scope="col">Acciones</th>
             </tr>
         </thead>
         <tbody>


             @foreach ($clientes as $cliente)
                 <tr>
                     <td>{{ $cliente->cedula }}</th>
                     <td>{{ $cliente->nombres }}</td>
                     <td>{{ $cliente->apellidos }}</td>
                     <td>{{ $cliente->celular }}</td>
                     <td>{{ $cliente->email }}</td>
                     <td>

                         <form class="form--inline" method="GET"
                             action="{{ route('customers.edit', ['id' => $cliente->id]) }}">
                             <button type="submit" class="btn btn-primary btn-sm">Editar</button>
                         </form>

                         <form class="form--inline" method="POST"
                             action="{{ route('customers.destroy', ['id' => $cliente->id]) }}">
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
