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
    Schema::table('animals', function (Blueprint $table) {
        $table->unsignedBigInteger('pere_id')->nullable()->after('id');
        $table->unsignedBigInteger('mere_id')->nullable()->after('pere_id');
        
        // Optionnel : Ajout des clés étrangères
        $table->foreign('pere_id')->references('id')->on('animals')->onDelete('set null');
        $table->foreign('mere_id')->references('id')->on('animals')->onDelete('set null');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('animals', function (Blueprint $table) {
            //
        });
    }
};
