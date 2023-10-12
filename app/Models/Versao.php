<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Versao extends Model
{
    use HasFactory;

    //definindo nome da tabela pois nao usamos o padrao
    protected $table = 'versoes' ;

    //definindo dados da request
    protected $fillable = ['nome','abreviacao','idioma_id'];

    //busca o relacionamento da tabela versao com idioma
    //tras o idioma vinculado a versao
    public function idioma()
    {
        return $this->belongsTo(Idioma::class);
    }

    public function livros()
    {
        return $this->hasMany(Livro::class);
    }

}
