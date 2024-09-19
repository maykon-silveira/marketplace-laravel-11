<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('slug');
            $table->text('capa');
            $table->integer('id_vendedor');
            $table->integer('categoria_id');
            $table->integer('sub_categoria_id')->default(0);
            $table->integer('filho_categoria_id')->default(0);
            $table->integer('id_marca');
            $table->integer('qtd');
            $table->text('descricao_curta');
            $table->text('descricao_longa');
            $table->text('video')->nullable();
            $table->string('codigo_barras')->nullable();
            $table->double('valor');
            $table->double('valor_oferta')->nullable();
            $table->date('inicio_oferta')->nullable();
            $table->date('fim_oferta')->nullable();
            $table->boolean('tipo_produto')->nullable();
            $table->boolean('status');
            $table->integer('aprovado')->default(0);
            $table->string('google_titulo')->nullable();
            $table->string('google_descricao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
