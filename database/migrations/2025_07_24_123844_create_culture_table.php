<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cultures', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('type');
            $table->string('periode_semis');
            $table->string('periode_recolte');

            // 🔁 Relation vers une parcelle
            $table->foreignId('parcelle_id')->nullable()->constrained('parcelles')->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cultures');
    }
};
