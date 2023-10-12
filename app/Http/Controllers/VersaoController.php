<?php

namespace App\Http\Controllers;

use App\Http\Resources\VersaoResource;
use App\Http\Resources\VersoesCollection;
use App\Models\Versao;
use Illuminate\Http\Request;

class VersaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //busca todos os dados da tabela
        //return Versao::all();


        //mudando a resposta para uma resource
        //podemos usar assim
        //chamando a resource  passando os dados todos os dados
        //return new VersoesCollection(Versao::all());

        //OU
        //selecionando dados para passa pra resource todos
        //return new VersoesCollection(Versao::select('id','nome','abreviacao','idioma_id')->get());

        //ou paginar por quantidade
        return new VersoesCollection(Versao::select('id','nome','abreviacao','idioma_id')->paginate(3));
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
        if(Versao::create($request->all())){
            return  response()->json([
                'message'   => 'Versao cadastrada com sucesso.'
            ] ,201);
        }

        return  response()->json([
            'message'   => 'Erro ao cadastrar versao'
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
        //busca padrao
        //$versao = Versao::findOrFail($id);

        //buscando com relacionamento nova maneira
        $versao = Versao::with('idioma','livros')->find($id);
        if($versao){
            //busca o idioma que a versao possui
            //$versao->idioma;
            //$versao->livros;
            //return $versao ;
            return new VersaoResource($versao);
        }
        return  response()->json([
            'message'   => 'Erro ao pesquisar versao'
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
        $vesao = Versao::findOrFail($id);
        if($vesao){
            //fazendo o update
            $vesao->update($request->all());
            return  $vesao ;
        }
        return  response()->json([
            'message'   => 'Erro ao atualizar versao'
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
        if(Versao::destroy($id)){
            return  response()->json([
                'message'   => 'Versao deletada com sucesso.'
            ] ,201);
        }

        return  response()->json([
            'message'   => 'Erro ao deletar versao'
        ] ,404);
    }
}
