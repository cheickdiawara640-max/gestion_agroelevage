<?php
namespace App\Exports;

use App\Models\Besoin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BesoinsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Besoin::select('id','titre','montant','date_demande','statut','description')->get();
    }

    public function headings(): array
    {
        return ['ID','Titre','Montant','Date demande','Statut','Description'];
    }
}
