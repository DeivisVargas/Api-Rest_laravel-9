<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testamento extends Model
{
    use HasFactory;

    //DEFINE OS PARAMETROS QUE A MODAL IRA RECEBER
    protected $fillable = ['nome'];

    public function livros()
    {
        //consulta todos os livros de um testamento
        //se usar a definição de chave estrangeira ele pega sozinho o relacionamento
        //caso contrario tem que passar qual e a chave estrangeira da tabela
        return $this->hasMany(Livro::class);
    }
}
