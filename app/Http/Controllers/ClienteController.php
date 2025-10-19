<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Movimento;
use App\Models\Produto;
use App\Models\Encomenda;
use App\Http\Controllers\MovimentoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\EncomendaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class ClienteController extends Controller
{

    public function dashboard($id){

        $movimento = Movimento::all();

        if($movimento){

            $clientMovimento = Movimento::where('id','like','%'.$id.'%')->exist();
            if($clientMovimento){

                $toltalCompra = sum($clientMovimento->quantity);
            }

            return redirect()->route('cliente.dashboard', compact('clientMovimento', 'movimento','totalCompra'));
        }else{

            return redirect()->route('cliente.dashboard', compact('movimento'));
        }

    }

    public function show(Cliente $cliente){

        return view('cliente.show', compact('cliente'));

    }

    public function edit(Cliente $cliente){

        return view('cliente.edit', compact('cliente'));

    }

    public function update(Request $request, Cliente $cliente)
    {

        $cliente->update($request->all());

        if(Auth::user()->role != 'Cliente'){

            $movimento = Movimento::create([
            'produto' => 'Cliente',
            'tipo' => 'Actualizado',
            'id_funcionario' => Auth::user()->id,
            'usuario' => Auth::user()->name,
        ]);

        }else{

            $movimento = Movimento::create([
            'produto' => 'Cliente',
            'tipo' => 'Actualizado',
            'usuario' => 'Próprio'
        ]);

        }

        return redirect()->route('cliente.dashboard')
        ->with('sucess', 'Detalhes Actualizado com Sucesso!');

    }

    public function destroy(Cliente $cliente){

        $cliente->delete();

        $movimento = Movimento::create([
            'produto' => 'Cliente',
            'tipo' => 'Deletado',
            'id_funcionario' => Auth::user()->id,
            'usuario' => Auth::user()->name
        ]);

        return redirect()->route('produto.index')
        ->with('sucess', 'Cliente Removido com Sucesso!');

    }

    public function busca(){

        return view('cliente.busca');

    }

    public function buscaProduto(Request $request)
    {
        $search = $request->input('search');
        
        if( $search ){
            $produto = Produto::where('id', 'like', '%'.$search.'%')->orWhere('name', 'like', '%'.$search.'%')->first();
            if ( $produto ){
                return view('cliente.busca', compact('produto', 'search') );
            }else{
                return redirect()->back()
            ->with('error','Produto não encontrado!');
            }
        
        }
        
    }

    public function encomenda(Request $request){

        $produto = Produto::find($request->id);

        if($produto->quantity >= $request->quantity){

            $encomenda = Encomenda::create([
            'produto' => $request->name,
            'id_produto' => $request->id,
            'quantity' => $request->quantity,
            'cliente' => $request->cliente
            ]);

            return redirect()
            ->route('cliente.busca')->with('sucess', 'Produto Encomendado Com Sucesso!');

        }else{
            return redirect()
            ->back()
            ->with('error','Quantidade Insuficiente');
        }

    }

    public function categoria($id){

        $cliente = Cliente::find($id);

        if($cliente->tipo == 'Comum'){

            $cliente->tipo = 'Especial';
            $cliente->save();

        }else{

            $cliente->tipo = 'Comum';
            $cliente->save();
        }

        return redirect()->back();

    }
       
}   
