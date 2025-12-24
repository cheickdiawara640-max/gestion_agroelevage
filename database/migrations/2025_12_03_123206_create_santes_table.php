<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('santes', function (Blueprint $table) {
            $table->id();
            $table->string('nom'); // Nom du suivi santé ou maladie
            $table->text('diagnostic'); // Champ obligatoire
            $table->text('traitement')->nullable(); // Traitement si applicable
            $table->date('date'); // Date du suivi
            $table->foreignId('animal_id')->constrained()->onDelete('cascade'); // Relie un animal
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('santes');
    }
};
