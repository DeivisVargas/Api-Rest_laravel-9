<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Versiculo extends Model
{
    use HasFactory;

    protected $fillable = ['capitulo','versiculo','texto','livro_id'];

    /*
     * Criando escopo de consultas
     * usar sempre a palavra scope no nome da função por convenção
     * */
    public function scopeFilter($query , $capitulo)
    {
        return $query->where('capitulo' , $capitulo);
    }
    /*
   * Pega o  livro do versiculo
   * */
    public function livro()
    {
        //chama o model testamento para poder consultar
        //belongsTo quer dizer que o livro pertence a um testamento
        return $this->belongsTo(Livro::class);
    }

}
