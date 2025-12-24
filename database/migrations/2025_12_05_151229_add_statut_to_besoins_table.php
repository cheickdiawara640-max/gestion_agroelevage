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
    Schema::table('besoins', function (Blueprint $table) {
        $table->string('statut')->default('en attente')->after('date_demande');
    });
}

public function down(): void
{
    Schema::table('besoins', function (Blueprint $table) {
        $table->dropColumn('statut');
    });
}

};
