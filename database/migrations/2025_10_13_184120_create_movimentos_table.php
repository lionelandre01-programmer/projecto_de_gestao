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
        Schema::create('movimentos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo');
            $table->string('produto');
            $table->string('usuario')->default("own");
            $table->integer('quantity')->nullable();

            $table->unsignedBigInteger('id_produto')->nullable();
            $table->foreign('id_produto')->references('id')->on('produtos');

            $table->unsignedBigInteger('id_funcionario')->nullable();
            $table->foreign('id_funcionario')->references('id')->on('funcionarios');

            $table->integer('id_encomenda')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimentos');
    }
};
