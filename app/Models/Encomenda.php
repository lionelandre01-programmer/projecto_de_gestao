<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Encomenda extends Model
{
    protected $fillable = [
        'produto',
        'cliente',
        'quantity',
        'status',
        'id_produto'
    ];

    public function movimentos(){

        return $this->hasMany(Movimento::class);
    }
}
