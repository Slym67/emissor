<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 50);
            $table->decimal('valor', 10, 2);
            $table->string('ncm', 10);
            $table->string('cfop_interno', 4);
            $table->string('cfop_externo', 4);
            $table->string('codigo_barras', 13);
            $table->string('unidade_venda', 10);

            $table->integer('categoria_id')->unsigned();
            $table->foreign('categoria_id')->references('id')
            ->on('categorias')->onDelete('cascade');

            $table->decimal('perc_icms', 10,2)->default(0);
            $table->decimal('perc_pis', 10,2)->default(0);
            $table->decimal('perc_cofins', 10,2)->default(0);
            $table->decimal('perc_ipi', 10,2)->default(0);

            $table->string('cst_csosn', 3)->default("");
            $table->string('cst_pis', 3)->default("");
            $table->string('cst_cofins', 3)->default("");
            $table->string('cst_ipi', 3)->default("");
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
        Schema::dropIfExists('produtos');
    }
}
