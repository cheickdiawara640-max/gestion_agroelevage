<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cultures', function (Blueprint $table) {
            // On ajoute la contrainte de clé étrangère APRÈS que toutes les tables soient créées
            $table->foreign('parcelle_id')
                  ->references('id')
                  ->on('parcelles')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cultures', function (Blueprint $table) {
            $table->dropForeign(['parcelle_id']);
        });
    }
};