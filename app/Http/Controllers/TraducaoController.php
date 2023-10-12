<?php

namespace App\Http\Controllers;

use App\Models\Traducoes;
use Illuminate\Http\Request;

class TraducaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //CONSULTA
        return Traducoes::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //INSERIR DADOS
        if(Traducoes::create($request->all())){
            return  response()->json([
                'message'   => 'Traducao cadastrada com sucesso.'
            ] ,201);
        }

        return  response()->json([
            'message'   => 'Erro ao cadastrar Traducoes'
        ] ,404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //busca por is busca mesmo que não existir
        //return Testamento::find($id);
        //assim busca por id mas da uma mensagem caso nao exista esse id no banco de dados
        $traducao = Traducoes::find($id);
        if($traducao){
            //busca os testamentos do livro atraves do model
            $traducao->testamento;

            //busca os versiculos do livro atraves do model
            $traducao->versiculos;
            return $traducao ;
        }
        return  response()->json([
            'message'   => 'Erro ao pesquisar o Livro'
        ] ,404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //buscando os dados do id
        $traducoes = Traducoes::find($id);
        if($traducoes){
            //fazendo o update
            $traducoes->update($request->all());
            return  $traducoes ;
        }
        return  response()->json([
            'message'   => 'Livro atualizado'
        ] ,404);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Traducoes::destroy($id)){
            return  response()->json([
                'message'   => 'Traducao deletada com sucesso.'
            ] ,201);
        }

        return  response()->json([
            'message'   => 'Erro ao deletar Traducao'
        ] ,404);
    }
}
