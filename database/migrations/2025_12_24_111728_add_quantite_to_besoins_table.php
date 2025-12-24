<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('besoins', function (Blueprint $table) {
        // On ajoute la colonne quantité avec une valeur par défaut de 0
        $table->integer('quantite')->default(0); 
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('besoins', function (Blueprint $table) {
            //
        });
    }
};
