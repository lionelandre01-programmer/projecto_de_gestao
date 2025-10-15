@extends('layout.main')

@section('content')

    @if (session('sucess'))
        <div style="width: 80%; background-color: aquamarine; height: 40px;">
            <h2 style="color: green;">{{ session('sucess') }}</h2>
        </div>
    @endif

    @if (session('error'))
        <div style="
        width: 80%; 
        height: 50px; 
        background: red; 
        display: flex; 
        justify-content: center; 
        align-items: center;
        border-radius: 10px;">
            <h2 style="text-align: center;">{{ session('error') }}</h2>
        </div>
    @endif

<form action="{{ route('buscaproduto.post') }}" method="get" style="margin: 10px;">

    @csrf
    <label for="id">Produto:</label>
    <input name="search" placheholder="informe o id ou nome" required>

    <button type="submit">Buscar</button>

</form>


@if ( isset($produto) && !is_null($produto) )
    

<form action="{{ route('venda', $produto) }}" method="POST" class="form_crud">

    @csrf
    @method('POST')
    <label for="id">Id</label>
    <input name="id" value="{{ $produto->id }}" readonly>

    <label for="name">Nome</label>
    <input name="name" value="{{ $produto->name }}" readonly>
    
    <label for="price">Preço</label>
    <input name="price" value="{{ $produto->price }}" readonly>
    
    <label for="quantity">Quantidade</label>
    <input value="{{ $produto->quantity }}" readonly>

    <label for="quantity">Quantidade a vender</label>
    <input type="number" name="quantity" min="1" placeholder="Quantidade a ser vendido" required>

    <label for="quantity">Usuário</label>
    <input name="name_user" value="{{ Auth::user()->name }}" readonly>

    <button type="submit" 
    style="margin: 10px; width: 120px; height: 40px; background: green;">
    Vender
    </button>

</form>

@endif

@endsection