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
        Schema::create('endereco_cliente', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('cliente')->onDelete('cascade');
            $table->foreignId('cidade_id')->constrained('cidade')->onDelete('cascade');
            $table->foreignId('estado_id')->constrained('estado')->onDelete('cascade');
            $table->string('rua');
            $table->string('bairro')->nullable();
            $table->string('numero_casa');
            $table->boolean('endereco_ativo')->default(1);
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
        Schema::dropIfExists('endereco_cliente');
    }
};
