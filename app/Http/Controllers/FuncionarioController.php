<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Movimento;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        $produto = Produto::all();

        if($produto){

            $totalProduto = Produto::count();
            $totalEstoque = Produto::sum('quantity');
            $maiorQuantity = Produto::orderBy('quantity','desc')->first();
            $menorQuantity = Produto::orderBy('quantity','asc')->first();
            $maiorPrice = Produto::orderBy('price','desc')->first();
            $menorPrice = Produto::orderBy('price','asc')->first();

            return view('funcionario.dashboard', 
            compact(
                'totalProduto',
                'totalEstoque',
                'maiorQuantity',
                'menorQuantity',
                'maiorPrice',
                'menorPrice',
                'produto'
            ));
            
        }else{

            return view('funcionario.dashboard', compact('produto'));
        }

        
    }

    public function movimento(){

        $movimento = Movimento::all();
        return view('funcionario.movimento', compact('movimento'));
    }

    public function show(Funcionario $funcionario)
    {
        return view('funcionario.show', compact('funcionario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Funcionario $funcionario)
    {
        return view('funcionario.edit', compact('funcionario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Funcionario $funcionario)
    {
        $funcionario->update($request->all());

        $movimento = Movimento::create([
            'produto' => 'Funcionário',
            'tipo' => 'Actualizado',
            'id_funcionario' => Auth::user()->id,
            'usuario' => Auth::user()->name

        ]);

        return redirect()->route('user.funcionario')
        ->with('sucess', 'Funcionário Actualizado com Sucesso!');;
    }

    public function worker(){

        $funcionario = Funcionario::all();
        return view('funcionario.worker', compact('funcionario'));
    }

    public function cliente(){

        $cliente = Cliente::all();
        return view('funcionario.client', compact('cliente'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Funcionario $funcionario)
    {
        $funcionario->delete();

        $movimento = Movimento::create([
            'produto' => 'Funcionário',
            'tipo' => 'Deletado',
            'id_funcionario' => Auth::user()->id,
            'usuario' => Auth::user()->name
        ]);

        return redirect()->route('funcionario.worker')
        ->with('sucess', 'Funcionário Removido com Sucesso!');
    }


    public function busca(){

        return view('produto.busca');
    }

    public function buscaproduto(Request $request)
    {
        $search = $request->input('search');
        
        if( $search ){

            $produto = Produto::where('id', 'like', '%'.$search.'%')->orWhere('name', 'like', '%'.$search.'%')->first();
            if ( $produto ){

                return view('produto.busca', compact('produto', 'search') );
            }else{

                return redirect()->back()
            ->with('error','Produto não encontrado!');
            }
        
        }else{
            $produto = null;
        }
        
    }

    public function venda(Request $request){

        $id = $request->id;
        $quantity = $request->quantity;

        $produto = Produto::where('id', 'like', '%'.$id.'%')->first();

        if($produto->quantity >= $quantity){
            $produto->quantity -= $quantity;
            $produto->save();

            $movimento = Movimento::create([
            'produto' => $produto->name,
            'tipo' => 'vendido',
            'quantity' => '-' . $quantity,
            'id_funcionario' => Auth::user()->id,
            'usuario' => Auth::user()->name
            ]);

            return redirect()
            ->route('produto.busca')->with('sucess', 'Produto Vendido Com Sucesso!');

        }else{
            return redirect()
            ->back()
            ->with('error','Quantidade Insuficiente');
        }

    }

    public function buscaProdutoExist(){

        return view('produto.update');
    }

    public function bringProduto(Request $request)
    {
        $search = $request->input('search');
        
        if( $search ){

            $produto = Produto::where('id', 'like', '%'.$search.'%')->orWhere('name', 'like', '%'.$search.'%')->first();
            if ( $produto ){

                return view('produto.update', compact('produto', 'search') );
            }else{

                return redirect()->back()
            ->with('error','Produto não encontrado!');
            }
        
        }else{

            $produto = null;
        }
        
    }

    public function updateProduto(Request $request){

        $id = $request->id;
        $quantity = $request->quantity;
        $first_quantity = $request->first_quantity;

        $produto = Produto::where('id', $id)->first();
        $produto->quantity += $quantity;
        $produto->save();

            $movimento = Movimento::create([
            'produto' => $produto->name,
            'tipo' => 'Quantidade Actualizado',
            'quantity' => $produto->quantity,
            'id_funcionario' => Auth::user()->id,
            'usuario' => Auth::user()->name
            ]);

        return redirect()
        ->route('produto.busca')
        ->with('sucess', 'Produto Actualizado Com Sucesso!');


    }

    public function encomenda(){

        $movimento = Movimento::where('tipo','Encomenda')->all();
        return view('funcionario.encomenda', compact('movimento'));
    }
}
