<?php

namespace App\Http\Controllers;

use App\Models\Versiculo;
use Illuminate\Http\Request;

class SiteController extends Controller
{

    public function index()
    {
        $versiculoDoDia = Versiculo::with(['livro'])->find(rand(2,4));
        return response()->json($versiculoDoDia) ;
    }
    public function ler_a_biblia($versao , $livro = null ,$capitulo = null , $versiculo = null)
    {
        //recebendo um versiculo para listar usar whereHas para fazer filtro dentro da tabela de livros
        //é como se fosse um where de banco de dados
        //whereHas seria como os inner join no banco de dados
        $versiculos = Versiculo::whereHas('livro' , function ($query) use ($versao,$livro,$capitulo,$versiculo){
            //agora estamos dentro da tabela de livros
            //porem dentro do livro somente temos o id então temos que entras na tabela de versoes
            $query->whereHas('versao', function ($query) use ($versao){
                //agora estamos dentro da tabela de versao
                //fazendo um filtro por abreviação
                $query->where('abreviacao' , $versao);
            });
            //apos o primeiro filtro de abreviação da versão faz mais um com a abreviação do livro
            $query->when($livro , function ($query) use ($livro){
                $query->where('abreviacao' , $livro);
            })->when($capitulo , function ($query) use ($capitulo){
                //filtro por capitulo
                $query->where('capitulo' , $capitulo);
            })->when($versiculo , function ($query) use ($versiculo){
                //filtro por versiculo
                $query->where('versiculo' , $versiculo);
            });
        })->get() ;

        return response()->json($versiculos);

    }

    public function ler_a_biblia_por_id($versao_id)
    {
        //recebendo um versiculo para listar usar whereHas para fazer filtro dentro da tabela de livros
        //é como se fosse um where de banco de dados
        //whereHas seria como os inner join no banco de dados
        $versiculos = Versiculo::whereHas('livro' , function ($query) use ($versao_id){
            //agora estamos dentro da tabela de livros
            //e vamos fazer o where da versao_id recebido como parâmetro na rota
            $query->where('versao_id' , $versao_id);
        })->get() ;

        return response($versiculos , 200);

    }
}
