@extends('layout.main')

@section('content')

    <br>
    <h1 style="margin-left: 200px; align-self: start; color: green;">Editar Produto</h1>

    <form action="{{ route('produto.update', $produto) }}" method="POST" class="form_crud">
        @csrf
        @method('PUT')

        <label for="name">Nome</label>
        <input type="text" name="name" value="{{ $produto->name }}">

        <label for="price">Preço</label>
        <input type="number" name="price" value="{{ $produto->price }}" required>

        <label for="quantity">Quantidade</label>
        <input type="number" name="quantity" value="{{ $produto->quantity }}">

        <input type="hidden" name="user_name" value="{{ Auth::user()->name }}">

        <label for="description">Descrição</label>
        <textarea name="description">{{ $produto->description }}</textarea>

        <div class="div_btn">
            <button type="submit">Actualizar</button>
        <button>
            <a href="{{ route('produto.index') }}" style="color: black;">Voltar</a>
        </button>
        </div>
        
    </form>

@endsection