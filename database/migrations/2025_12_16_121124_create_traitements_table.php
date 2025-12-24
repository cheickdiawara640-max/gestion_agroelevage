<?php

// database/migrations/YYYY_MM_DD_HHMMSS_create_traitements_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('traitements', function (Blueprint $table) {
            $table->id();
            
            // Relation : À quelle culture ou parcelle ce traitement s'applique-t-il ?
            $table->foreignId('culture_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('parcelle_id')->nullable()->constrained()->onDelete('set null');

            // Détails du traitement
            $table->string('nom_produit'); // Ex: 'Fongicide A', 'Insecticide B'
            $table->string('type_produit'); // Ex: 'Pesticide', 'Fongicide', 'Herbicide', 'Engrais'
            $table->decimal('dose', 8, 2); // Dose utilisée (ex: litres/hectare ou grammes/m²)
            $table->string('unite_dose', 10); // Ex: 'L/Ha', 'g/m2'
            $table->date('date_application');
            $table->text('notes')->nullable();
            
            // Sécurité et traçabilité
            $table->date('date_recolte_attendue')->nullable(); // Pour gérer le délai avant récolte (DSR)
            $table->string('appliquer_par')->nullable(); // Le personnel qui a appliqué le traitement

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('traitements');
    }
};

