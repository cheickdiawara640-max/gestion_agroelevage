<?php

namespace App\Exports;

use App\Models\Besoin;
use Maatwebsite\Excel\Concerns\FromCollection;

class BesoinExport implements FromCollection
{
    public function collection()
    {
        return Besoin::all();
    }
}
