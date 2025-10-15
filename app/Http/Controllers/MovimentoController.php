<?php

namespace App\Http\Controllers;

use App\Models\Movimento;
use App\Models\Produto;
use App\Models\User;
use App\Models\Cliente;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ClienteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovimentoController extends Controller
{

    public function index(Movimento $movimento)
    {
        $movimento = Movimento::all();

        return view('user.movimento', compact('movimento'));
    }

    public function cliente()
    {
        $id = Auth::user()->id;
        $movimento = Movimento::where('id', $id)->exist();

        return view('cliente.movimento', compact('movimento'));
    }

}
