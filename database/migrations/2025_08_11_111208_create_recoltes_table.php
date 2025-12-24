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
    Schema::create('recoltes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('parcelle_id')->constrained()->onDelete('cascade');
        $table->string('culture');
        $table->integer('quantite'); // en kg
        $table->date('date_recolte');
        $table->text('remarques')->nullable();
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('recoltes');
    }
};
