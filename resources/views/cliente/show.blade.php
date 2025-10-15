@extends('layout.main')

@section('content')

    <br>
    <h1 style="margin-left: 200px; align-self: start; color: green;">Visualizar Informações do Cliente</h1>

    <div class="form_crud">

        <label>Nome</label>
        <input value="{{ $cliente->name }}" readonly>

        <label>E-Mail</label>
        <input value="{{ $cliente->email }}" readonly>

        <label>Data de nascimento</label>
        <input value="{{ date('d/m/Y', strtotime($cliente->date)) }}" readonly>

        <label>Categoria</label>
        <input value={{ $cliente->role }} readonly>

        <div class="div_btn">
            <button>
                <a href="{{ route('cliente.dashboard') }}" style="color: black;">Voltar</a>
            </button>
        </div>

    </div>

@endsection