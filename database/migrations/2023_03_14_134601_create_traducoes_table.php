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
        Schema::create('traducoes', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->nullable();
            $table->string('abreviacao')->nullable();
            $table->unsignedBigInteger('idioma_id');
            $table->timestamps();

            //definindo a cahve estrangeira da tabela
            $table->foreign('idioma_id')->references('id')->on('idiomas');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('traducoes');
    }
};
