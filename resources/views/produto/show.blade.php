@extends('layout.main')

@section('content')

    <br>
    <h1 style="margin-left: 200px; align-self: start; color: green;">Visualizar Detalhes</h1>

    <div class="form_crud">


        @if (Auth::check())
            <label>Id</label>
        <input value="{{ $produto->id }}" readonly>
        @endif
        
        <label>Nome</label>
        <input value="{{ $produto->name }}" readonly>

        <label>Preço</label>
        <input value="{{ $produto->price }}"kz readonly>

        @if (Auth::check())
        <label>Quantidade</label>
        <input value="{{ $produto->quantity }}" readonly>
        @endif

        <label>Descrição</label>
        <textarea readonly>{{ $produto->description }}</textarea>

        <div class="div_btn">
            <button>
                <a href="{{ route('produto.index') }}" style="color: black;">Voltar</a>
            </button>
        </div>

    </div>

@endsection