<?php

// database/migrations/YYYY_MM_DD_HHMMSS_create_ventes_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ventes', function (Blueprint $table) {
            $table->id();
            
            // Lier la vente à l'origine du produit (Récolte)
            $table->foreignId('recolte_id')->constrained()->onDelete('cascade'); 
            
            // Champs du mode de vente et transaction
            $table->date('date_vente');
            $table->string('produit_vendu'); // Ex: Nom ou type de la récolte (Maïs, Tomate...)
            $table->decimal('quantite_vendue', 8, 2);
            $table->string('unite_quantite', 10);
            $table->decimal('prix_unitaire', 8, 2);
            $table->decimal('montant_total', 10, 2);
            $table->string('mode_vente'); // Ex: Vente Directe, Grossiste, etc.
            $table->string('mode_paiement')->nullable(); // Ex: Espèces, Virement, Chèque
            $table->string('client_nom')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ventes');
    }
};