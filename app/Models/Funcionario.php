<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Funcionario extends Model
{
    protected $fillable = [
        'name',
        'genero',
        'date',
        'id_user',
        'role',
        'email'

    ];

    protected static function boot(){

        parent::boot();

        static::deleting( function($funcionario){

            $funcionario->user()->delete();
        });

    } 

    public function User(): BelongsTo{

        return $this->belongsTo(User::class, 'id_user');

    }

}
