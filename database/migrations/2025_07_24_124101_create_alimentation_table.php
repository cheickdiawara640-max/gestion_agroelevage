<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alimentations', function (Blueprint $table) {
            $table->id();
            // C'est ici que l'erreur doit être : vérifie bien les parenthèses et le point-virgule à la fin
            $table->foreignId('animal_id')->nullable()->constrained()->onDelete('set null');
            $table->string('type_aliment');
            $table->integer('quantite');
            $table->date('date_distribution');
            $table->timestamps();
        }); // Vérifie bien qu'il y a ce ");" ici
    

    public function down(): void
    {
        Schema::dropIfExists('alimentations');
    }
};
