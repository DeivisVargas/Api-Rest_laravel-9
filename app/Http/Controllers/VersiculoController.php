<?php

namespace App\Http\Controllers;

use App\Http\Resources\VersiculoResource;
use App\Http\Resources\VersiculosCollection;
use App\Models\Versiculo;
use Illuminate\Http\Request;

class VersiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //consulta todos os dados
        //return  Versiculo::all();

        //resposta usando collection
        return new VersiculosCollection(Versiculo::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if(Versiculo::create($request->all())){
            return  response()->json([
                'message'   => 'Versiculo cadastrado com sucesso.'
            ] ,201);
        }

        return  response()->json([
            'message'   => 'Erro ao cadastrar Versiculo'
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
        //com o relacionamento de livro with
        $versiculo = Versiculo::with('livro')->find($id);

        if($versiculo){

            //realcionamento de livro no versiculo
            //$versiculo->livro;
            //return $versiculo ; retorno padrao da model

            //retorno com resource
            return new VersiculoResource($versiculo);
        }
        return  response()->json([
            'message'   => 'Erro ao pesquisar o Versiculo'
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

        $versiculo = Versiculo::find($id);
        if($versiculo){
            $versiculo->update($request->all());
            return  $versiculo ;
        }
        return  response()->json([
            'message'   => 'Erro ao atualizar Versiculo'
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

        if(Versiculo::destroy($id)){
            return  response()->json([
                'message'   => 'Versiculo deletado com sucesso.'
            ] ,201);
        }

        return  response()->json([
            'message'   => 'Erro ao deletar Versiculo'
        ] ,404);
    }
}
