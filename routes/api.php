<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestamentoController ;
use App\Http\Controllers\LivroController ;
use App\Http\Controllers\AuthController ;
use App\Http\Controllers\VersiculoController ;
use App\Http\Controllers\IdiomaController;
use App\Http\Controllers\TraducaoController;
use App\Http\Controllers\VersaoController;
use App\Http\Controllers\SiteController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//usando token sanctum para proteger as rotas
Route::group(['middleware' => ['auth:sanctum'] ], function(){
    //PORTEGENDO AS ROTAS COM TOKEN SANCTUM


    //ROTAS TESTAMENTO adicionando nomes as rotas para poder devolver no conceito HATEOAS
    Route::get("/testamento" , [TestamentoController::class , 'index'])->name('testamento.index');
    Route::get("/testamento/{id}" , [TestamentoController::class , 'show'])->name('testamento.show');
    Route::put("/testamento/{id}" , [TestamentoController::class , 'update'])->name('testamento.update');
    Route::delete("/testamento/{id}" , [TestamentoController::class , 'destroy'])->name('testamento.destroy');
    Route::post("/testamento" , [TestamentoController::class , 'store'])->name('testamento.store');



    //ROTAS LIVROS adicionando nomes as rotas para poder devolver no conceito HATEOAS
    Route::get("/livro" , [LivroController::class , 'index'])->name('livro.index');
    Route::get("/livro/{id}" , [LivroController::class , 'show'])->name('livro.show');
    Route::put("/livro/{id}" , [LivroController::class , 'update'])->name('livro.update');
    Route::delete("/livro/{id}" , [LivroController::class , 'destroy'])->name('livro.destroy');
    Route::post("/livro" , [LivroController::class , 'store'])->name('livro.store');


    //ROTAS VERSICULO adicionando nomes as rotas para poder devolver no conceito HATEOAS
    Route::get("/versiculo" , [VersiculoController::class , 'index'])->name('versiculo.index');
    Route::get("/versiculo/{id}" , [VersiculoController::class , 'show'])->name('versiculo.show');
    Route::put("/versiculo/{id}" , [VersiculoController::class , 'update'])->name('versiculo.update');
    Route::delete("/versiculo/{id}" , [VersiculoController::class , 'destroy'])->name('versiculo.destroy');
    Route::post("/versiculo" , [VersiculoController::class , 'store'])->name('versiculo.store');


    //ROTAS IDIOMAS  adicionando nomes as rotas para poder devolver no conceito HATEOAS
    Route::get("/idioma" , [IdiomaController::class , 'index'])->name('idioma.index');
    Route::get("/idioma/{id}" , [IdiomaController::class , 'show'])->name('idioma.show');
    Route::put("/idioma/{id}" , [IdiomaController::class , 'update'])->name('idioma.update');
    Route::delete("/idioma/{id}" , [IdiomaController::class , 'destroy'])->name('idioma.destroy');
    Route::post("/idioma" , [IdiomaController::class , 'store'])->name('idioma.store');

    //ROTAS TRADUCOES adicionando nomes as rotas para poder devolver no conceito HATEOAS
    Route::get("/traducao" , [TraducaoController::class , 'index'])->name('traducao.index');
    Route::get("/traducao/{id}" , [TraducaoController::class , 'show'])->name('traducao.show');
    Route::put("/traducao/{id}" , [TraducaoController::class , 'update'])->name('traducao.update');
    Route::delete("/traducao/{id}" , [TraducaoController::class , 'destroy'])->name('traducao.destroy');
    Route::post("/traducao" , [TraducaoController::class , 'store'])->name('traducao.store');

    //ROTAS VERSAO adicionando nomes as rotas para poder devolver no conceito HATEOAS
    Route::get("/versao" , [VersaoController::class , 'index'])->name('versao.index');
    Route::get("/versao/{id}" , [VersaoController::class , 'show'])->name('versao.show');
    Route::put("/versao/{id}" , [VersaoController::class , 'update'])->name('versao.update');
    Route::delete("/versao/{id}" , [VersaoController::class , 'destroy'])->name('versao.destroy');
    Route::post("/versao" , [VersaoController::class , 'store'])->name('versao.store');

    //rota de logout
    Route::post('/logout' , [AuthController::class , 'logout'])->name('logout') ;

});




Route::post('/register' , [AuthController::class , 'register'])->name('register');
Route::post('/login' , [AuthController::class , 'login'])->name('login') ;


//ROTAS DO SITE DE BUSCA DE INFORMAÇÕES NA API COMO SE FOSSE UM CLIENTE CONSUMINDO O SERVIÇO
//USAMOS A INTERROGAÇÃO QUANDO O PARAMETRO PASSADO NÃO É OBRIGATÓRIO
Route::get('/site' ,[SiteController::class ,'index'])->name('site.index');
Route::get('/site/{versao}/{livro?}/{capitulo?}/{versiculo?}', [SiteController::class , 'ler_a_biblia'])->name('site.ler_a_biblia');
//BUSCA POR ID
Route::get('/site/id/{ID}', [SiteController::class , 'ler_a_biblia_por_id'])->name('site.ler_a_biblia_por_id');
/*
 *
 * melhoria de rotas apiResource ja cria as rotas padroes de CRUD porem o parametro
 * recebido muda para o nome da rota
 *
    Route::apiResource('testamento',TestamentoController::class);
    Route::apiResource('livro',LivroController::class);
    Route::apiResource('versiculo',VersiculoController::class);

Tambem podemos definir em forma de Array dessa maneira ele ja nomeia as rotas de forma padrão
Route::apiResource([
        'testamento'    => TestamentoController::class ,
        'livro'         => LivroController::class,
        'versiculo'     => VersiculoController::class
]);

*/


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
