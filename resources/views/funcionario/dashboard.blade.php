@extends('layout.main')

@section('content')

    @if (session('sucess'))
        <div style="width: 80%; background-color: aquamarine; height: 40px;">
            <h2 style="color: green;">{{ session('sucess') }}</h2>
        </div>
    @endif

    <br>
    <h1 style="margin-left: 130px; align-self: start; color: green;">DashBoard</h1>

@if ($produto->isEmpty())

    <div style="
    width: 80%; 
    height: 50px; 
    background: red; 
    display: flex; 
    justify-content: center; 
    align-items: center;
    border-radius: 10px;">
        <h2 style="text-align: center;">Sem Produtos No Estoque</h2>
    </div>

@else

<div style="background: brown; width: 80%; border-radius: 10px; padding: 10px;">

    <div style="display: flex; justify-content: space-around;">
        <div class="max">
            <h2>Máxima Quantidade</h2>
            <p>Produto: {{ $maiorQuantity->name }}</p>
            <p>Quantidade: {{ $maiorQuantity->quantity }} Unidades</p>
        </div>

        <div class="min" style=" $menorQuantity->quantity =< 15 ? 'color: red' : 'color: black;' ">
            <h2>Mínima Quantidade</h2>
            <p>Produto: {{ $menorQuantity->name }}</p>
            <p>Quantidade: {{ $menorQuantity->quantity }} Unidades</p>
        </div>
    </div>
    

    <div class="total">
        <h1><span style="color: cadetblue;">Total De Produtos Em Estoque: </span>{{ $totalProduto }}</h1>
    </div>

    <div class="total">
        <h1><span style="color: cadetblue;">Total De Quantidade Em Estoque: </span>{{ $totalEstoque }}</h1>
    </div>

    <div style="display: flex; justify-content: space-around;">

        <div class="max">
            <h2>Mais Caro</h2>
            <p>Produto: {{ $maiorPrice->name }}</p>
            <p>Preço: {{ number_format($maiorPrice->price, 2, ',','.') }}kz</p>
        </div>

        <div class="min">
            <h2>Mais Barato</h2>
            <p>Produto: {{ $menorPrice->name }}</p>
            <p>Preço: {{ number_format($menorPrice->price, 2, ',','.') }}kz</p>
        </div>
    </div>

</div>

@endif


@endsection