<?php

namespace App\Http\Controllers;

use App\Models\Encomenda;
use Illuminate\Http\Request;
use App\Models\Movimento;
use App\Models\Produto;
use Illuminate\Support\Facades\Auth;

class EncomendaController extends Controller
{

    public function index()
    {
        $encomenda = Encomenda::all();
        return view('funcionario.encomenda', compact('encomenda'));
    }


    public function confirmar($id)
    {
        $encomenda = Encomenda::find($id);
        $produto_id = $encomenda->id_produto;
        $quantity = $encomenda->quantity;
        $produto = Produto::find($produto_id);
        $encomenda->status = 'Entregue';
        $encomenda->save();

        $movimento = Movimento::create([
            'id_encomenda' => $encomenda->id,
            'id_produto' => $produto->id,
            'produto' => $produto->name,
            'id_produto' => $produto->id,
            'quantity' => '-' . $quantity,
            'usuario' => Auth::user()->name,
            'tipo' => 'Encomenda ' . $encomenda->status,
        ]);

        $produto->quantity -= $quantity;
        $produto->save();

        $encomenda->delete();

        return redirect()->route('encomenda');
    }


    public function anular($id)
    {
        $encomenda = Encomenda::find($id);
        $produto_id = $encomenda->id_produto;
        $quantity = $encomenda->quantity;
        $produto = Produto::find($produto_id);
        $encomenda->status = 'Anulado';
        $encomenda->save();

        $movimento = Movimento::create([
            'id_encomenda' => $encomenda->id,
            'id_produto' => $produto->id,
            'produto' => $produto->name,
            'id_produto' => $produto->id,
            'quantity' => '-' . $quantity,
            'usuario' => Auth::user()->name,
            'tipo' => 'Encomenda ' . $encomenda->status,
        ]);

        $encomenda->delete();

        return redirect()->route('encomenda');
    }

}
