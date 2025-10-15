@extends('layout.main')

@section('content')

<h1 style="margin-left: 130px; align-self: start; color: green;">Clientes</h1>

@if ($cliente->isEmpty())

    <div style="
        width: 80%; 
        height: 50px; 
        background: red; 
        display: flex; 
        justify-content: center; 
        align-items: center;
        border-radius: 10px;">
            <h2 style="text-align: center;">Sem Clientes Registradas</h2>
    </div>
    
@else

    <table>

    <tr>
        <th>Id</th>
        <th>Nome</th>
        <th>Gênero</th>
        <th>Tipo De Cliente</th>
    </tr>

    @foreach ($cliente as $clientes)
    
        <tr>
            <td>{{ $clientes->id }}</td>
            <td>{{ $clientes->name }}</td>
            <td>{{ $clientes->genero }}</td>
            <td>{{ $clientes->tipo }}</td>
        </tr>

    @endforeach

</table>
    
@endif



@endsection