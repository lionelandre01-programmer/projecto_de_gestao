@extends('layout.main')

@section('content')

    @if (session('sucess'))
        <div style="width: 80%; background-color: aquamarine; height: 40px;">
            <h2 style="color: green;">{{ session('sucess') }} <span>{{ Auth::user()->name }}</span></h2>
        </div>
    @endif

    <br>
    <h1 style="margin-left: 130px; align-self: start; color: green;">DashBoard</h1>

@if ($movimento->isEmpty() || $clientMovimento->isEmpty())

    <div style="
    width: 80%; 
    height: 50px; 
    background: red; 
    display: flex; 
    justify-content: center; 
    align-items: center;
    border-radius: 10px;">
        <h2 style="text-align: center;">Sem Produtos Comprados</h2>
    </div>

@else

<div style="background: brown; width: 80%; border-radius: 10px;">

        <div style="width: 100%;"><h2 style="text-align: center;">Produtos Comprados</h2></div>


    <div class="total">
        <h1><span style="color: cadetblue;">Total De Produtos Comprado: </span>{{ count($clientMovimento) }}</h1>
    </div>

    <div class="total">
        <h1><span style="color: cadetblue;">Total De Quantidade Comprado: </span>{{ $totalCompra }}</h1>
    </div>

</div>

@endif


@endsection