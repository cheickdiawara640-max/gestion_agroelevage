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
            $table->string('type'); // ex: foin, maïs, aliment concentré
            $table->text('description')->nullable();
            $table->integer('quantite'); // en kg ou litres
            $table->date('date_alimentation');
            $table->unsignedBigInteger('animal_id')->nullable(); // lien avec un animal
            $table->timestamps();

            // Clé étrangère correcte
            $table->foreign('animal_id')->references('id')->on('animals')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alimentations');
    }
};
