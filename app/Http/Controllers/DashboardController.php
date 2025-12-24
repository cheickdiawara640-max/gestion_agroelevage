<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Animal;
use App\Models\Parcelle;
use App\Models\Culture;
use App\Models\Recolte;
use App\Models\Alimentation;
use App\Models\Sante;
use App\Models\Budget;
use App\Models\Besoin;
use App\Models\Personnel;
use App\Models\Traitement;
use App\Models\Vente;
use App\Models\Task;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    private function getCards()
    {
        return [
            'elevage' => [
                ['icon'=>'🐄','title'=>'Animaux','count'=>Animal::count(),'badge'=>Animal::where('etat_sante','malade')->count().' malades','color'=>'#68D391','route'=>'animaux.index'],
                ['icon'=>'🍽️','title'=>'Alimentation','count'=>Alimentation::count(),'badge'=>'','color'=>'#9F7AEA','route'=>'alimentations.index'],
                ['icon'=>'💊','title'=>'Santé','count'=>Sante::count(),'badge'=>'','color'=>'#FC8181','route'=>'santes.index'],
                ['icon'=>'🧪','title'=>'Traitements','count'=>Traitement::count(),'badge'=>'','color'=>'#B37546','route'=>'traitements.index'],
            ],
            'agriculture' => [
                ['icon'=>'🟩','title'=>'Parcelles','count'=>Parcelle::count(),'badge'=>'','color'=>'#48BB78','route'=>'parcelles.index'],
                ['icon'=>'🌾','title'=>'Cultures','count'=>Culture::count(),'badge'=>'','color'=>'#ED8936','route'=>'cultures.index'],
                ['icon'=>'🧺','title'=>'Récoltes','count'=>Recolte::count(),'badge'=>'','color'=>'#63B3ED','route'=>'recoltes.index'],
            ],
            'gestion' => [
                ['icon'=>'💰','title'=>'Budgets','count'=>Budget::count(),'badge'=>'','color'=>'#667EEA','route'=>'budgets.index'],
                ['icon'=>'💲','title'=>'Ventes','count'=>Vente::count(),'badge'=>'','color'=>'#2F855A','route'=>'ventes.index'],
                ['icon'=>'📦','title'=>'Besoins','count'=>Besoin::count(),'badge'=>'','color'=>'#F687B3','route'=>'besoins.index'],
                ['icon'=>'👤','title'=>'Personnel','count'=>Personnel::count(),'badge'=>'','color'=>'#A0AEC0','route'=>'personnels.index'],
            ]
        ];
    }

    public function index()
    {
        $cards = $this->getCards();
        $graphData = [];
        foreach ($cards as $secteur => $liste) {
            foreach ($liste as $card) {
                $graphData[] = [
                    'label' => $card['title'],
                    'count' => (int)$card['count'],
                    'color' => $card['color'],
                ];
            }
        }

        $tasks = Task::where('est_terminee', false)->orderBy('date_echeance', 'asc')->get();

        // --- STATS DE PERFORMANCE ---
        $naissances = Animal::where('created_at', '>=', now()->startOfMonth())->count(); 
        $deces = Animal::where('etat_sante', 'mort')->count();
        $totalRecolte = Recolte::sum('quantite'); 
        $totalVentes = Vente::sum('montant_total');
        $totalDepenses = Budget::sum('montant');
        $beneficeNet = $totalVentes - $totalDepenses;
        
        $besoinsUrgent = Besoin::count();
        $optimisationScore = max(0, 100 - ($besoinsUrgent * 10)); 

        $alertes = [];
        try {
            $malades = Animal::where('etat_sante', 'malade')->get();
            foreach($malades as $a) {
                $alertes[] = ['icon' => '🤒', 'message' => "L'animal " . ($a->code_animal ?? $a->nom) . " est malade."];
            }
        } catch (\Exception $e) {}

        $stocksCritiques = [];
        if (Schema::hasColumn('besoins', 'quantite')) {
            $stocksCritiques = Besoin::where('quantite', '<', 5)->get();
            foreach($stocksCritiques as $stock) {
                $alertes[] = ['icon' => '⚠️', 'message' => "Stock faible : " . $stock->nom];
            }
        }

        return view('dashboard.index', compact(
            'cards', 'graphData', 'alertes', 'tasks', 
            'beneficeNet', 'optimisationScore', 'stocksCritiques',
            'naissances', 'deces', 'totalRecolte'
        ));
    }
}