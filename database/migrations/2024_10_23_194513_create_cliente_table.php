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
        Schema::create('cliente', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vigilante_id')->constrained('users')->onDelete('cascade');
            $table->string('cliente_nome');
            $table->boolean('cliente_ativo')->default(1);
            $table->string('cliente_celular');
            $table->double('cliente_mensalidade');
            $table->integer('cliente_vencimento');
            $table->string('chat_id')->nullable();
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
        Schema::dropIfExists('cliente');
    }
};
