<?php

use Illuminate\Support\Facades\Route;
use App\Models\Produto;
use App\Models\User;
use App\Models\Movimento;
use App\Models\Cliente;
use App\Models\Funcionario;
use App\Models\Encomenda;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MovimentoController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EncomendaController;

Route::get('/',[ProdutoController::class, 'index'])->name('produto.index');

/** Rotas Do Produto */
Route::group(['prefix' => 'product', 'middleware' => 'auth'], function(){

    Route::get('/cliente',[ProdutoController::class, 'cliente'])->name('produto.cliente');
    Route::get('/create',[ProdutoController::class, 'create'])->name('produto.create');
    Route::post('/create',[ProdutoController::class, 'store'])->name('produto.store');
    Route::get('/show/{produto}',[ProdutoController::class, 'show'])->name('produto.show');
    Route::get('/edit/{produto}',[ProdutoController::class, 'edit'])->name('produto.edit');
    Route::put('/update/{produto}',[ProdutoController::class, 'update'])->name('produto.update');
    Route::delete('/delete/{produto}',[ProdutoController::class, 'destroy'])->name('produto.destroy')->middleware('permissao');
});


/** Rotas Do Usuário */
Route::group(['prefix' => 'user'], function(){

    Route::get('/login',[UserController::class, 'formlogin'])->name('login');
    Route::post('/login',[UserController::class, 'login'])->name('login.post');
    Route::get('/register',[UserController::class, 'formregister'])->name('user.register');
    Route::post('/register',[UserController::class, 'register'])->name('register.post');
    Route::post('/logout',[UserController::class, 'logout'])->name('user.logout');
});



/** Rotas Do Movimento */
Route::group(['prefix' => 'moviment', 'middleware' => 'auth'], function(){

    Route::get('/user',[MovimentoController::class, 'index'])->name('user.movimento');
    Route::get('/cliente/{cliente}',[MovimentoController::class, 'cliente'])->name('cliente.movimento');
});


/** Rotas Do Cliente */

Route::group(['prefix' => 'client', 'middleware' => 'auth'], function(){

    Route::get('/show/{cliente}',[ClienteController::class, 'show'])->name('cliente.show');
    Route::get('/edit/{cliente}',[ClienteController::class, 'edit'])->name('cliente.edit');
    Route::put('/update/{cliente}',[ClienteController::class, 'update'])->name('cliente.update');
    Route::delete('/destroy/{cliente}',[ClienteController::class, 'destroy'])->name('cliente.destroy');
    Route::get('/busca',[ClienteController::class, 'busca'])->name('cliente.busca');
    Route::post('/busca/produto',[ClienteController::class, 'buscaProduto'])->name('busca.post');
    Route::post('/encomenda',[ClienteController::class, 'encomenda'])->name('encomenda.post');
    Route::get('/dashboard',[ClienteController::class, 'dashboard'])->name('cliente.dashboard');
});


/** Rotas Do Funcionário */

Route::group(['prefix' => 'worker', 'middleware' => 'auth'], function(){

    Route::get('/show/{funcionario}',[FuncionarioController::class, 'show'])->name('funcionario.show')->middleware('permissao');
    Route::get('/edit/{funcionario}',[FuncionarioController::class, 'edit'])->name('funcionario.edit')->middleware('permissao');
    Route::put('/update/{funcionario}',[FuncionarioController::class, 'update'])->name('funcionario.update')->middleware('permissao');
    Route::delete('/destroy/{funcionario}',[FuncionarioController::class, 'destroy'])->name('funcionario.destroy')->middleware('permissao');
    Route::get('/dashboard',[FuncionarioController::class, 'dashboard'])->name('funcionario.dashboard');
    Route::get('/busca',[FuncionarioController::class, 'busca'])->name('produto.busca');
    Route::get('/venda',[FuncionarioController::class, 'buscaproduto'])->name('buscaproduto.post');
    Route::post('/vendido/{produto}',[FuncionarioController::class, 'venda'])->name('venda');
    Route::get('/buscaproduto',[FuncionarioController::class, 'buscaProdutoExist'])->name('produtoExist.busca');
    Route::get('/actualizar',[FuncionarioController::class, 'bringProduto'])->name('bring.post');
    Route::get('/movimentos',[FuncionarioController::class, 'movimento'])->name('funcionario.movimento')->middleware('permissao');
    Route::get('/funcionarios',[FuncionarioController::class, 'worker'])->name('funcionario.worker')->middleware('permissao');
    Route::get('/clientes',[FuncionarioController::class, 'cliente'])->name('funcionario.cliente')->middleware('permissao');
    Route::post('/actualizado/{produto}',[FuncionarioController::class, 'updateProduto'])->name('update');
    Route::post('/categoria/{id}',[ClienteController::class, 'categoria'])->name('categoria');

});


Route::group(['prefix' => 'encomenda', 'middleware' => 'auth'], function(){

    Route::get('/',[EncomendaController::class, 'index'])->name('encomenda');
    Route::post('/confirmar/{id}',[EncomendaController::class, 'confirmar'])->name('confirmar');
    Route::post('/anular/{id}',[EncomendaController::class, 'anular'])->name('anular');
});
