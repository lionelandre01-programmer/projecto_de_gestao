<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Produto;
use App\Models\User;

class Movimento extends Model
{
    protected $fillable = ['tipo',
    'quantity',
    'produto',
    'usuario',
    'id_produto',
    'id_funcionario',
    'id_encomenda'
    ];

}
