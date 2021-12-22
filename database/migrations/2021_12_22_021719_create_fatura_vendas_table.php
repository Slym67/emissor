<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaturaVendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fatura_vendas', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('venda_id')->unsigned();
            $table->foreign('venda_id')->references('id')
            ->on('vendas')->onDelete('cascade');

            $table->string('forma_pagamento', 15);
            $table->decimal('valor', 10, 2);
            $table->date('vencimento');
            
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
        Schema::dropIfExists('fatura_vendas');
    }
}
