<?php
namespace App\Exports;

use App\Models\Parcelle;
use Maatwebsite\Excel\Concerns\FromCollection;

class ParcelleExport implements FromCollection
{
    public function collection()
    {
        return Parcelle::all();
    }
}
