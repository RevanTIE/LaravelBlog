<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Si se siguió la convención de nombres de Laravel:
     * Laravel asocia el 'id' de tabla 'usuarios' con el 
     * campo de llave foránea 'user_id' en la tabla 'entradas'. 
     * De lo contrario, se tiene que establecer el nombre
     * de la llave foránea y del campo id como parámetros en la función 'hasMany()';
     */
    public function entradas(){
        return $this->hasMany('App\Models\Entrada');
    }

    public function comentarios(){
        return $this->hasMany('App\Models\Comentario');
    }
}
