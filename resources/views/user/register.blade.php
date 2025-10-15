@extends('layout.main')

@section('content')

    <form action="{{ route('register.post') }}" method="POST" class="form_crud">

        @csrf
        <label for="name">Nome</label>
        <input type="text" name="name" required>

        <label for="date">Data de Nascimento</label>
        <input type="date" name="date" required>

        @if ( ($user)->isEmpty() || Auth::check() )
            
            <label for="role">Função</label>
            <select name="role">
                <option value="admin">Administrador</option>
                <option value="Manager">Chefe do departamento</option>
                <option value="worker">Simples funcionário</option>
            </select>
        
        @endif
        
        <label for="email">E-Mail</label>
        <input type="email" name="email" required>

        <label for="genero">Genero</label>
        <select name="genero">
            <option value="M">Masculino</option>
            <option value="F">Feminino</option>
        </select>

        <label for="password">Palavra-Passe</label>
        <input type="password" name="password" required>

        <div class="div_btn">

            <button type="submit">Registrar</button>

            <button>
                <a href="{{ Auth()->check() ? route('funcionario.worker') : route('produto.index') }}" style="color: black;">Voltar</a>
            </button>
        </div>
        
    </form>

@endsection