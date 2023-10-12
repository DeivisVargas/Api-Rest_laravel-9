<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;

    //Define os parametros que a model irá receber
    protected $fillable = ['posicao','nome','abreviacao','testamento_id' , 'versao_id','capa'];

    /*
     * Pega o testamento vinculado ao livro
     * */
    public function testamento()
    {
        //chama o model testamento para poder consultar
        //belongsTo quer dizer que o livro pertence a um testamento
        return $this->belongsTo(Testamento::class);
    }

    //retorna todos livros de um versiculo
    public function versiculos()
    {
        //pertence a muitos versiculos
        return $this->hasMany(Versiculo::class);
    }

    public function versao(){
        //pertence a uma versao
       return $this->belongsTo(Versao::class);
    }
}
