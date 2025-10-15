@extends('layout.main')

@section('content')

<h1 style="margin-left: 130px; align-self: start; color: green;">Encomendas</h1>

@if ($encomenda->isEmpty())

    <div style="
        width: 80%; 
        height: 50px; 
        background: red; 
        display: flex; 
        justify-content: center; 
        align-items: center;
        border-radius: 10px;">
            <h2 style="text-align: center;">Sem Encomentas Registradas</h2>
    </div>
    
@else

    <table class="encomenda-table">

    <tr>
        <th>Id</th>
        <th>Produto</th>
        <th>Quantidade</th>
        <th>Cliente</th>
        <th>Conclusão</th>
        <th>Data</th>
        <th>Acções</th>
    </tr>

    @foreach ($encomenda as $encomendas)
    
        <tr>
            <td>{{ $encomendas->id }}</td>
            <td>{{ $encomendas->produto }}</td>
            <td>{{ $encomendas->quantity }}</td>
            <td>{{ $encomendas->cliente }}</td>
            <td>{{ $encomendas->status }}</td>
            <td>{{ $encomendas->created_at }}</td>
            <td style="display: flex; justify-content: space-around;">

                @if (Auth::user()->role != 'Cliente')
                    <form action="{{ route('confirmar', $encomendas->id) }}" method="POST">
                    @csrf
                    @method('POST')
                   <button class="btn-encomenda" style="background: green; width: 80px;">
                    Confirmar
                    </button> 
                </form>
                @endif
                
                <form action="{{ route('anular', $encomendas->id) }}" method="POST">

                    @csrf
                    @method('POST')
                    <button class="btn-encomenda" style="background: red; width: 80px;">
                    Anular
                    </button>
                </form>
                
            </td>
        </tr>

    @endforeach

</table>
    
@endif


@endsection