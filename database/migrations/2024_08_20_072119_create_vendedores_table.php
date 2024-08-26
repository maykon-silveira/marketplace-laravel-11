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
        Schema::create('vendedores', function (Blueprint $table) {
            $table->id();
            $table->text('banner');
            $table->string('fone');
            $table->string('email');
            $table->text('endereco');
            $table->text('descricao');
            $table->text('fb_link')->nullable();
            $table->text('insta_link')->nullable();
            $table->text('x_link')->nullable();
            $table->text('yt_link')->nullable();
            $table->integer('id_usuario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendedores');
    }
};
