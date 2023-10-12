<?php

namespace App\Http\Controllers;

use App\Http\Resources\TestamentoResource;
use App\Http\Resources\TestamentosCollection;
use App\Models\Testamento;
use Illuminate\Http\Request;


class TestamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //consulta todos os dados da tabela
        //return Testamento::all();

        //usando a resurce collection
        return new TestamentosCollection(Testamento::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //CREATE da model vai inserir os dados no banco de dados $request all seria todos os dados

        if(Testamento::create($request->all())){
            return  response()->json([
                'message'   => 'Testamento cadastrado com sucesso.'
            ] ,201);
        }

        return  response()->json([
            'message'   => 'Erro ao cadastrar Testamento'
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
        $testamento = Testamento::with('livros')->find($id);
        /*
         *
        if($Testamento){
            return $Testamento ;
        }
        */
        if($testamento){
            //carrega os livros que contem esse testamento direto da model
            //$testamento->livros ;

            //return $testamento ;
            return new TestamentoResource($testamento);

        }
        return  response()->json([
            'message'   => 'Erro ao pesquisar o Testamento'
        ] ,404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        //buscando os dados do id
        $testamento = Testamento::find($id);
        if($testamento){
            $testamento->update($request->all());
            return  $testamento ;
        }
        return  response()->json([
            'message'   => 'Erro ao atualizar Testamento'
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
        //DELETA DADOS
        if(Testamento::destroy($id)){
            return  response()->json([
                'message'   => 'Testamento deletado com sucesso.'
            ] ,201);
        }

        return  response()->json([
            'message'   => 'Erro ao deletar Testamento'
        ] ,404);
    }
}
