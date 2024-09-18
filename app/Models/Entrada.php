<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Por convención, el nombre del modelo en singular, apunta al nombre de la tabla en plural.
 */
class Entrada extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'titulo',
        'contenido',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function comentarios(){
        return $this->hasMany('App\Models\Comentario');
    }
}
