<?php

namespace App\Exports;

use App\Models\Alimentation;
use Maatwebsite\Excel\Concerns\FromCollection;

class AlimentationExport implements FromCollection
{
    public function collection()
    {
        return Alimentation::all();
    }
}
