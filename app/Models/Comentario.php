<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Por convención, el nombre del modelo en singular, apunta al nombre de la tabla en plural.
 */
class Comentario extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'contenido',
        'user_id',
        'entrada_id'
    ];
    /**
     * Convenciones usadas cuando el nombre de la tabla no concuerda con el nombre del 
     * modelo en plural. Y cuando el id de la tabla no es 'id':
     */
    protected $table = 'comentarios';
    protected $primaryKey = 'id';

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function entrada(){
        return $this->belongsTo('App\Models\Entrada');
    }

}
