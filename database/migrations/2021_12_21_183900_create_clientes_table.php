<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 50);
            $table->string('rua', 80);
            $table->string('numero', 10);
            $table->string('bairro', 30);
            $table->string('complemento', 100);
            $table->string('cep', 9);
            $table->string('telefone', 15);
            $table->string('cpf_cnpj', 18);
            $table->string('ie_rg', 15);
            $table->boolean('contribuinte');

            $table->integer('cidade_id')->unsigned();
            $table->foreign('cidade_id')->references('id')
            ->on('cidades')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
