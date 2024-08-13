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
        Schema::create('produto_materiasprimas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_produto');
            $table->unsignedBigInteger('id_materiaprima');
            $table->float('quantidade', precision: 53);
            $table->unsignedBigInteger('und_id');
            $table->timestamps();

            $table->foreign('id_produto')->references('id')->on('produtos');
            $table->foreign('id_materiaprima')->references('id')->on('materiaprimas');
            $table->foreign('und_id')->references('id')->on('unidades');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produto_materiasprimas');
    }
};
