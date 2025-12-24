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
    Schema::create('settings', function (Blueprint $table) {
        $table->id();
        $table->string('key')->unique();
        $table->text('value')->nullable();
        $table->timestamps();
    });

    // Insertion des paramètres par défaut pour que ça marche direct
    DB::table('settings')->insert([
        ['key' => 'ferme_nom', 'value' => 'DIAWARA TECH AGRO'],
        ['key' => 'devise', 'value' => 'FCFA'],
        ['key' => 'contact_tel', 'value' => '+223 00 00 00 00'],
    ]);
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
