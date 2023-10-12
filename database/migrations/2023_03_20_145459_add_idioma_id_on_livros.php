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
        Schema::table('livros', function (Blueprint $table) {
            //adicionar nulo para nao dar problema na hora da criação da chave
            $table->unsignedSmallInteger('versao_id')->nullable();//
            $table->foreign('versao_id')->references('id')->on('versoes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('livros', function (Blueprint $table) {
            //caso der problema ao rodar migrate  ele entra aqui
            $table->dropColumn('versao_id');
        });
    }
};
