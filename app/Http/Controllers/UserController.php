<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Produto;
use App\Models\Movimento;
use App\Models\Cliente;
use App\Models\Funcionario;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class UserController extends Controller
{
    public function cliente(){

        $produto = Produto::all();
        return view('produto.cliente');
    }

    public function formlogin(){

        return view('user.login');

    }

    public function login(Request $request){

        $credentials = $request->only(['email','password']);
        $email = $request->input('email');
        $client = Cliente::where('email',$email)->exists();

        if(Auth::attempt($credentials)){
            
            if($client){

                return redirect()->route('produto.cliente')
                ->with('sucess', 'Bem-Vindo de volta');

            }else{
                return redirect()->route('produto.index')
                ->with('sucess', 'Bem-Vindo de volta');
            }
            
        }

        return redirect()->back()->with('error','Dados inválidos');
    }

    public function formregister(){

        $user = User::all();
        $userAdmin = User::where('role','admin')->first();
        return view('user.register', compact('user','userAdmin'));

    }

    public function register(Request $request){

        $user = User::Create($request->all());

        if( !$request->filled('role') ){

            Cliente::create([
                'name' => $user->name,
                'id_user' => $user->id,
                'genero' => $user->genero,
                'date' => $user->date,
                'email' => $user->email
            ]);

            Auth::login($user);
            return redirect()->intended(route('produto.cliente'))
            ->with('sucess', 'Usuário Criado com Sucesso!');

        }else{

            if(Auth::check()){

                Funcionario::create([
                'name' => $user->name,
                'id_user' => $user->id,
                'genero' => $user->genero,
                'date' => $user->date,
                'role' => $user->role,
                'email' => $user->email
                ]);

                $movimento = Movimento::create([
                'produto' => $user->name,
                'tipo' => 'Novo Usuário',
                'id_funcionario' => Auth::user()->id,
                'usuario' => Auth::user()->name,
                ]);

                return redirect()->intended(route('funcionario.worker'))
                ->with('sucess', 'Usuário Criado Com Sucesso!');

            }else{

                Funcionario::create([
                'name' => $user->name,
                'id_user' => $user->id,
                'genero' => $user->genero,
                'date' => $user->date,
                'role' => $user->role,
                'email' => $user->email
                ]);

                $movimento = Movimento::create([
                'produto' => $user->name,
                'tipo' => 'Novo Usuário'
                ]);

                Auth::login($user);
                return redirect()->intended(route('funcionario.dashboard'))
                ->with('sucess', 'Bem-Vindo!');
            }

            
        }
            
    }

    public function logout(){

        Auth::logout();

        return redirect()->route('produto.index');

    }

}
