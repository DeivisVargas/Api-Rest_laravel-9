<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livros', function (Blueprint $table) {
            $table->id();
            $table->integer("posicao");
            $table->string("nome")->nullable();
            $table->string("abreviacao")->nullable();
            $table->string("capa")->nullable();
            //criando a chave estrangeira da tabela
            $table->unsignedBigInteger("testamento_id");
            $table->timestamps();


            //definindo a cahve estrangeira da tabela
            $table->foreign("testamento_id")->references("id")->on("Testamentos");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('livros');
    }
};
