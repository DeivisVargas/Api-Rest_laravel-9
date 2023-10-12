<?php

namespace App\Http\Controllers;

use App\Http\Resources\IdiomaResource;
use App\Models\Idioma;
use Illuminate\Http\Request;

class IdiomaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Idioma::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Adiciona idioma
        if(Idioma::create($request->all())){
            return  response()->json([
                'message'   => 'Idioma cadastrado com sucesso.'
            ] ,201);
        }

        return  response()->json([
            'message'   => 'Erro ao cadastrar idioma.'
        ] ,201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //faz a busca e testa se houver falhas na consulta . Retorna os dados da pesquisa por id
        //$idioma = Idioma::findOrFail($id);

        //carregamento com relacionamento da resource
        //necessario em caso de uso de resource
        $idioma = Idioma::with('versoes')->find($id);

        if($idioma){
            //chama o relacionamento das versoes do idioma
            //relacionamento foi alterado para a resource da Api
            //$idioma->versoes;
            //esses relacionamentos acima somente sao aplicaveis em caso de usar a resposta da model padrao
            //caso utilizar resources devemos mandar ja para a resource o relacionamento caregado com with


            //fazendo a esposta atraves de uma resource
            return new IdiomaResource($idioma) ;
        }

        return  response()->json([
            'message'   => 'Erro ao consultar idioma.'
        ] ,400);
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
        $idioma = Idioma::findOrFail($id);
        if($idioma){
            $idioma->update($request->all());
            return  $idioma ;
        }
        return  response()->json([
            'message'   => 'Idioma atualizado'
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
        //deletando idioma
        if(Idioma::destroy($id)){
            return  response()->json([
                'message'   => 'Idioma deletado com sucesso.'
            ] ,201);
        }
        return  response()->json([
            'message'   => 'Erro ao deletar idioma.'
        ] ,404);
    }
}
