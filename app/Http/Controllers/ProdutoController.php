<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\User;
use App\Models\Movimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produto = Produto::all();
        return view('produto.index', compact('produto'));
    }

    public function cliente(){

        $produto = Produto::all();
        return view('produto.cliente', compact('produto'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('produto.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $exist = $request->input('name');
        $verify = Produto::where('name',$exist)->exists();
        
        if( $verify ){

                return redirect()->back()
            ->with('error','O produto já existe');

        }else{
            
            $produto = Produto::create($request->all());
            

            $movimento = Movimento::create([
                'tipo' => 'Entrada',
                'quantity' => $produto->quantity,
                'produto' => $produto->name,
                'id_produto' => $produto->id,
                'id_funcionario' => Auth::user()->id,
                'usuario' => Auth::user()->name,
            ]);

            return redirect()->route('produto.index', compact('produto'))
            ->with('sucess', 'Produto cadastrado Com Sucesso!');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)
    {
        return view('produto.show', compact('produto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produto $produto)
    {
        return view('produto.edit', compact('produto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto)
    {
        $produto->update($request->all());

        $movimento = Movimento::create([
            'tipo' => 'Alterado',
            'quantity' => $produto->quantity,
            'produto' => $produto->name,
            'id_produto' => $produto->id,
            'id_funcionario' => Auth::user()->id,
            'usuario' => Auth::user()->name
        ]);

        return redirect()->route('produto.index', compact('produto'))->with('sucess', 'Produto Actualizado Com Sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Produto $produto)
    {

        $movimento = Movimento::create([
            'tipo' => 'Deletado',
            'quantity' => '-' . $produto->quantity,
            'produto' => $produto->name,
            'id_produto' => $produto->id,
            'id_funcionario' => Auth::user()->id,
            'usuario' => Auth::user()->name
        ]);

        $produto->delete();

        return redirect()->route('produto.index')->with('sucess', 'Produto Eliminado Com Sucesso!');
    }

}
