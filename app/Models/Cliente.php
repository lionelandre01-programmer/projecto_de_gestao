<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cliente extends Model
{
    
    protected $fillable = [
    'name',
    'genero',
    'date',
    'id_user',
    'email',
    'role'
    ];

    protected static function boot(){

        parent::boot();

        static::deleting( function($cliente){

            $cliente->user()->delete();
        });
    } 

    public function User(): BelongsTo{

        return $this->belongsTo(User::class, 'id_user');

    }

}
