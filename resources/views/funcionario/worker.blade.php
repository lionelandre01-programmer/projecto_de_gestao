@extends('layout.main')

@section('content')

<button class="btn_novo">
        <a href="{{ route('user.register') }}" style="color: black">Novo Funcionário</a>
</button>

<h1 style="margin-left: 130px; align-self: start; color: green;">Funcionários</h1>

@if ($funcionario->isEmpty())

    <div style="
        width: 80%; 
        height: 50px; 
        background: red; 
        display: flex; 
        justify-content: center; 
        align-items: center;
        border-radius: 10px;">
            <h2 style="text-align: center;">Sem Funcionários Registradas</h2>
    </div>
    
@else

    <table>

    <tr>
        <th>Id</th>
        <th>Nome</th>
        <th>Cargo</th>
        <th>Acções</th>
    </tr>

    @foreach ($funcionario as $funcionarios)
    
        <tr>
            <td>{{ $funcionarios->id }}</td>
            <td>{{ $funcionarios->name }}</td>
            <td>{{ $funcionarios->role }}</td>
            <td style="display: flex; justify-content: space-around;">
                <button>
                    <a href="{{ route('funcionario.show', $funcionarios->id) }}" style="color: black;">Ver</a>
                </button>

                    <button>
                        <a href="{{ route('funcionario.edit', $funcionarios->id) }}" style="color: black;">Editar</a>
                    </button>
                    
                    <form action="{{ route('funcionario.destroy', $funcionarios->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Deseja eliminar?')">Deletar</button>
                    </form>

            </td>
        </tr>

    @endforeach

</table>
    
@endif


@endsection