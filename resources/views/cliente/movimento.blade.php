@extends('layout.main')

@section('content')

<h1 style="margin-left: 130px; align-self: start; color: green;">Compras</h1>

@if ($movimento->isEmpty())

    <div style="
        width: 80%; 
        height: 50px; 
        background: red; 
        display: flex; 
        justify-content: center; 
        align-items: center;
        border-radius: 10px;">
            <h2 style="text-align: center;">Sem Compras Registradas</h2>
    </div>
    
@else

    <table>

    <tr>
        <th>Id</th>
        <th>Produto</th>
        <th>Quantidade</th>
        <th>Data</th>
    </tr>

    @foreach ($movimento as $movimentos)
    
        <tr>
            <td>{{ $movimentos->id }}</td>
            <td>{{ $movimentos->produto }}</td>
            <td>{{ $movimentos->quantity }}</td>
            <td>{{ $movimentos->created_at }}</td>
        </tr>

    @endforeach

</table>
    
@endif



@endsection