<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DashboardExport implements FromArray, WithHeadings
{
    protected $stats;

    public function __construct()
    {
        $this->stats = [
            'Animaux' => \App\Models\Animal::count(),
            'Parcelles' => \App\Models\Parcelle::count(),
            'Cultures' => \App\Models\Culture::count(),
            'Récoltes' => \App\Models\Recolte::count(),
            'Alimentations' => \App\Models\Alimentation::count(),
            'Santés' => \App\Models\Sante::count(),
            'Budgets' => \App\Models\Budget::count(),
            'Besoins' => \App\Models\Besoin::count(),
            'Personnels' => \App\Models\Personnel::count(),
        ];
    }

    public function array(): array
    {
        $data = [];
        foreach($this->stats as $key => $value){
            $data[] = [$key, $value];
        }
        return $data;
    }

    public function headings(): array
    {
        return ['Entité', 'Nombre'];
    }
}
