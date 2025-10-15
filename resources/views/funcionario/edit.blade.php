@extends('layout.main')

@section('content')

    <br>
    <h1 style="margin-left: 200px; align-self: start; color: green;">Editar Detalhes do Usuário</h1>

    <form action="{{ route('funcionario.update', $funcionario) }}" method="POST" class="form_crud">
        @csrf
        @method('PUT')

        @if (Auth::user()->role != 'Admin' && Auth::user()->role != 'Manager' )

            <label for="name">Nome</label>
            <input type="text" name="name" value="{{ $funcionario->name }}" required>

            <label for="date">Data de Nascimento</label>
            <input type="date" name="date" value="{{ $funcionario->date }}" required>

            <label for="email">E-Mail</label>
            <input type="email" name="email" value="{{ $funcionario->email }}" required>

            <label for="role">Função</label>
            <input type="text" name="role" value="{{ $funcionario->role }}" required>

            <label for="password">Palavra-Passe</label>
            <input type="text" name="password" value="{{ $funcionario->password }}" required>

            <div class="div_btn">
                <button type="submit" onclick="return confirm('Deseja Alterar?')">Actualizar</button>
            <button>
                <a href="{{ route('funcionario.worker') }}" style="color: black;">Voltar</a>
            </button>
            </div>
            
        @else

            <label for="name">Nome</label>
            <input type="text" name="name" value="{{ $funcionario->name }}" readonly>

            <label for="date">Data de Nascimento</label>
            <input type="date" name="date" value="{{ $funcionario->date }}" readonly>

            <label for="email">E-Mail</label>
            <input type="email" name="email" value="{{ $funcionario->email }}" readonly>

            <label for="role">Função</label>
            <select name="role">
                <option value="Worker">Simples Funcionário</option>
                <option value="Manager">Gestor</option>
            </select>

            <input type="hidden" name="password" value="{{ $funcionario->password }}" readonly>

            <div class="div_btn">
                <button type="submit">Actualizar</button>
                <button>
                    <a href="{{ route('funcionario.worker') }}" style="color: black;">Voltar</a>
                </button>
            </div>
            
        @endif
        
    </form>

@endsection