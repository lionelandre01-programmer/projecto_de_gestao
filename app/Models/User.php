<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Produto;
use App\Models\Movimento;
use App\Models\Cliente;
use App\Models\Funcionario;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'nickname',
        'email',
        'genero',
        'password',
        'role',
        'date',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function Produto(): HasMany
    {
        return $this->hasMany(Produto::class);
    }

    public function User(): HasOne
    {
        return $this->hasOne(Cliente::class);
    }

    public function Funcionario(): HasOne
    {
        return $this->hasOne(Funcionario::class);
    }

    public function hasRole($roles){

        if (is_array($roles)){
            return in_array($this->role, $roles);
        }
        return $this->role === $roles;
    }

}
