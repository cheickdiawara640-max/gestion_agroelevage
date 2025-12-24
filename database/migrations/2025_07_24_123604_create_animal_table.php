<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('race')->nullable(); // nullable pour éviter l'erreur
            $table->date('date_naissance')->nullable(); // si tu veux que ce soit optionnel
            $table->string('sexe')->nullable(); // optionnel si besoin
            $table->string('etat_sante')->nullable(); // ajouté si tu veux cet attribut
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
