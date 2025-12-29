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
            $table->foreignId('animal_id')->nullable()->constrained()->onDelete('set null');
            $table->string('type_aliment');
            $table->integer('quantite');
            $table->date('date_distribution');
            $table->timestamps();
        });
    } // <-- Cette accolade manquait ici !

    public function down(): void
    {
        Schema::dropIfExists('alimentations');
    }
};
