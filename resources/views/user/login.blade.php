@extends('layout.main')

@section('content')

    <form action="{{ route('login.post') }}" method="POST" class="form_crud">
        
        @csrf
        <label for="email">E-Mail</label>
        <input type="email" name="email" required>

        <label for="password">Palavra-Passe</label>
        <input type="password" name="password" value = "" required>

        <div class="div_btn">

            <button type="submit">Entrar</button>
            <button>
                <a href="{{ route('produto.index') }}" style="color: black;">Voltar</a>
            </button>
        </div>
        
    </form>

@endsection