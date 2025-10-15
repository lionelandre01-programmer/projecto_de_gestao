@extends('layout.main')

@section('content')

    <br>
    <h1 style="margin-left: 200px; align-self: start; color: green;">Visualizar Informações do Cliente</h1>

    <div class="form_crud">

        <label>Nome</label>
        <input value="{{ $funcionario->name }}" readonly>

        <label>E-Mail</label>
        <input value="{{ $funcionario->email }}" readonly>

        <label>Data de nascimento</label>
        <input value="{{ date('d/m/Y', strtotime($funcionario->date)) }}" readonly>

        <label>Categoria</label>
        <input value="{{ $funcionario->role }}" readonly>

        <div class="div_btn">
            <button>
                <a href="{{ route('funcionario.worker') }}" style="color: black;">Voltar</a>
            </button>
        </div>

    </div>

@endsection