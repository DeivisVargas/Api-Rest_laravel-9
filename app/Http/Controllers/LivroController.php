<?php

namespace App\Http\Controllers;
//importa a modelagem para poder usar as funções de banco da classe
use App\Http\Resources\LivroResource;
use App\Http\Resources\LivrosCollection;
use App\Models\Livro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB ;
use Illuminate\Support\Facades\Storage;

class LivroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //CONSULTA
        //exemplo de consulta sem usar migrate
        //$dados = DB::select('SELECT * FROM  livros WHERE id = ? ', [8]);


        //return Livro::paginate(2);
        //retorno padrao
        //return Livro::all();

        //retornando a resource
        return new LivrosCollection(Livro::all());
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
        if(Livro::create($request->all())){
            return  response()->json([
                'message'   => 'Livro cadastrado com sucesso.'
            ] ,201);
        }

        return  response()->json([
            'message'   => 'Erro ao cadastrar Livro'
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

        //$livro = Livro::find($id);
        $livro = Livro::with('testamento','versiculos','versao')->find($id);
        //buscando a url de download do arquivo
        $link = Storage::disk('public')->url($livro->capa) ;

        if($livro){
            //busca os testamentos do livro atraves do model
            //$livro->testamento;

            //busca os versiculos do livro atraves do model
            //$livro->versiculos;

            //busca a versao no qual o livro pertence
            //$livro->versao;

            //criando o campo download na classe para retornar o campo pro cliente
            $livro->download = $link ;
            return new LivroResource($livro) ;
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
        //usando o parametro da request temos varias coisas que podem ser capturadas
        //dd($request->capa->hashName());

        //pega o nome original do arquivo
        //dd($request->capa->getClientOriginalName());

        //serve para salvar o arquivo na pasta public que pode ser configurada em config/filesistens
        $path = $request->capa->store('capa_livro', 'public');


        //rodar no terminal  php artisan storage:link
        //para criar um atalho na pasta publico devido a regras de acesso na pasta storage não e possivel acessar


        $livro = Livro::find($id);
        if($livro){
            //nao podemos mais usar assim devido ao envio de arquivo
            //$livro->update($request->all());

            //temos que usar o metodo save nessa situação
            $livro->capa = $path ;
            if($livro->save()){
                return $livro;
            }else{
                return  response()->json([
                    'message'   => 'Erro ao atualizar livro'
                ] ,404);
            }

        }
        return  response()->json([
            'message'   => 'Erro ao atualizar livro'
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
        if(Livro::destroy($id)){
            return  response()->json([
                'message'   => 'Livro deletado com sucesso.'
            ] ,201);
        }

        return  response()->json([
            'message'   => 'Erro ao deletar Livro'
        ] ,404);
    }
}
