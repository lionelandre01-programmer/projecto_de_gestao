<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistema de gestão de estoque">
    <meta name="author" content="Lionel Cristóvão André">
    <title>Layout</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
    <header>
        <h1>LIONANDRE COMPANY</h1>
        @if (Auth::check())
        <nav class="menu" id="menu">
            <ul>
                
                
                    @if ( Auth::user()->role == 'Admin')
                        <li><a href="{{ route('funcionario.dashboard') }}">DashBoard</a></li>
                        <li><a href="{{ route('funcionario.movimento') }}">Movimentos</a></li>
                        <li><a href="{{ route('funcionario.worker') }}">Funcionários</a></li>
                        <li><a href="{{ route('funcionario.cliente') }}">Clientes</a></li>
                    @endif

                    @if ( Auth::user()->role != 'Cliente' )
                       <li><a href="{{ route('produto.index') }}">Produtos</a></li>
                        <li><a href="{{ route('produto.busca') }}">Venda</a></li>
                    @else

                        <li><a href="{{ route('produto.cliente') }}">Produtos</a></li>
                        <li><a href="{{ route('cliente.busca') }}">Compra</a></li>

                    @endif

                    <li><a href="{{ route('encomenda') }}">Encomendas</a></li>
                    
                    <form action="{{ route('user.logout') }}" method="POST">

                        @csrf
                        @method('POST')
                        <button type="submit" style="background: transparent; width: 90%; border: 1px solid black; border-radius: 5px;"
                        onclick="return confirm('Deseja Sair?')">Logout</button>
                    </form
            </ul>
        </nav>

        <button 
        style="width: 10%; 
        height: 40%; 
        font-size: 27px; 
        background: cadetblue; 
        border: 1px solid black; 
        border-radius: 10px;"
        id="toggle-btn">&#9776;</button>

        @else 
            <div  style="display: flex; gap: 30px;">
                <p><a style="color: black;" href="{{ route('user.register') }}">Sign Up</a></p>
                <p><a style="color: black;" href="{{ route('login') }}">Login</a></p>
            </div>
            
                    
        @endif
    </header>

    @if(Auth::check() && Auth::user()->role != 'Cliente')
    <div class="painel">
        <h1>
            Painel De Trabalho De {{Auth::user()->name}}
        </h1>
    </div>

    @elseif ( Auth::check() && Auth::user()->role === 'Cliente' )

    <div class="painel">
        <h1>
            Painel Do Cliente {{Auth::user()->name}}
        </h1>
    </div>

    @endif

    @yield('content')
    
    <script src="{{ asset('script.js') }}"></script>

</body>
</html>