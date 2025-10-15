@extends('layout.main')

@section('content')

    @if (session('sucess'))
        <div style="width: 80%; background-color: aquamarine; height: 40px;">
        <h2 style="color: green;">{{ session('sucess') }}</h2>
        </div>
    @endif

    @if (Auth::check())
        <button class="btn_novo">
            <a href="{{ route('produto.create') }}" style="color: black">Novo Produto</a>
        </button>
            
        <button class="btn_novo" style="background-color: blue;">
            <a href="{{ route('produtoExist.busca') }}" style="color: black"><h3>Estoque</h3></a>
        </button>

    @endif

    <h1 style="margin-left: 130px; align-self: start; color: green;">Lista De Produtos</h1>

    @if ($produto->isEmpty())

        <div style="
        width: 80%; 
        height: 50px; 
        background: red; 
        display: flex; 
        justify-content: center; 
        align-items: center;
        border-radius: 10px;">
            <h2 style="text-align: center;">Lista Vazia</h2>
        </div>

    @else

        <table>

        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Acções</th>
        </tr>

        @foreach ($produto as $produtos)
            
       
        <tr style="{{ $produtos->quantity < 16 ? 'background-color: red': '' }}">

            <td>{{ $produtos->id }}</td>
            <td>{{ $produtos->name }}</td>
            <td>{{ number_format($produtos->price, 2, ',','.') }}kz</td>
            <td style="display: flex; justify-content: space-around;">
                <button>
                    <a href="{{ route('produto.show', $produtos->id) }}" style="color: black;">Ver</a>
                </button>

                @if (Auth::check() && Auth::user()->role != 'Worker' && Auth::user()->role != 'Cliente')
                    <button>
                    <a href="{{ route('produto.edit', $produtos->id) }}" style="color: black;">Editar</a>
                </button>
                
                <form action="{{ route('produto.destroy', $produtos->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Deseja eliminar?')">Deletar</button>
                </form>
                @endif
            </td>

        </tr>

        @endforeach
    </table>
            
    @endif
    
@endsection