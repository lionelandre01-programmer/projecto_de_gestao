@extends('layout.main')

@section('content')

    @if (session('error'))
        <div style="width: 40%; 
        background-color: red; 
        height: 40px; 
        display: flex; 
        align-items: center; 
        justify-content: center;
        border-radius: 10px; 
        margin-right: 97px;
        align-self: flex-end;">
        <h2>{{ session('error') }}</h2>
        </div>
    @endif

    <br>
    <h1 style="margin-left: 200px; align-self: start; color: green;">Cadastrar Produto</h1>

    <form action="{{ route('produto.store') }}" method="POST" class="form_crud">
        @csrf
        <label for="name">Nome</label>
        <input type="text" name="name" required>

        <label for="price">Preço</label>
        <input type="number" name="price" min="5" required>

        <label for="quantity">Quantidade</label>
        <input type="number" name="quantity" min="1" required>

        <label for="description">Descrição</label>
        <textarea name="description" id="description" required></textarea>

        <input type="hidden" name="id_user" min="1" value="{{ Auth::user()->id }}">
        <input type="hidden" name="name_user" value="{{ Auth::user()->name }}">

        <div class="div_btn">

            <button type="submit">Cadastrar</button>
            <button>
                <a href="{{ route('produto.index') }}" style="color: black;">Voltar</a>
            </button>
        </div>
        
    </form>

@endsection