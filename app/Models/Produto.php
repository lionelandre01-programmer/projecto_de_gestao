<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Movimento;

class Produto extends Model
{
    protected $fillable = ['name', 'price', 'quantity', 'description','id_user','name_user'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function produto(){
        return $this->hasMany(Movimento::class);
    }
}
