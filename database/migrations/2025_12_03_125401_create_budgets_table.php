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
    Schema::create('budgets', function (Blueprint $table) {
        $table->id();
        $table->string('nom'); // Exemple : nom de la dépense ou recette
        $table->decimal('montant', 15, 2); // Montant du budget
        $table->enum('type', ['recette', 'depense']); // Type de budget
        $table->date('date'); // Date de l’opération
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budgets');
    }
};
