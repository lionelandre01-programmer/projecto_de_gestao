@extends('layout.main')

@section('content')

    <br>
    <h1 style="margin-left: 200px; align-self: start; color: green;">Editar Detalhes do Usuário</h1>

    <form action="{{ route('cliente.update', $cliente) }}" method="POST" class="form_crud">
        @csrf
        @method('PUT')

        @if (Auth::user()->role == 'cliente')

            <label for="name">Nome</label>
            <input type="text" name="name" value="{{ $cliente->name }}" required>

            <label for="date">Data de Nascimento</label>
            <input type="date" name="date" value="{{ $cliente->date }}" required>

            <label for="email">E-Mail</label>
            <input type="email" name="email" value="{{ $cliente->email }}" required>

            <label for="role">Função</label>
            <input type="email" name="email" value="{{ $cliente->email }}" required>

            <label for="password">Palavra-Passe</label>
            <input type="text" name="password" value="{{ $cliente->password }}" required>

            <div class="div_btn">
                <button type="submit">Actualizar</button>
            <button>
                <a href="{{ route('cliente.dashboard') }}" style="color: black;">Voltar</a>
            </button>
            </div>
            
        @else

            <label for="name">Nome</label>
            <input type="text" name="name" value="{{ $cliente->name }}" readonly>

            <label for="date">Data de Nascimento</label>
            <input type="date" name="date" value="{{ $cliente->date }}" readonly>

            <label for="email">E-Mail</label>
            <input type="email" name="email" value="{{ $cliente->email }}" readonly>

            <label for="role">Função</label>
            <input type="email" name="email" value="{{ $cliente->role }}" required>

            <input type="hidden" name="password" value="{{ $cliente->password }}" readonly>

            <div class="div_btn">
                <button type="submit">Actualizar</button>
            <button>
                <a href="{{ route('funcionario.client') }}" style="color: black;">Voltar</a>
            </button>
            </div>
            
        @endif
        
    </form>

@endsection