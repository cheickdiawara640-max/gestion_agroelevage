<?php
namespace App\Exports;

use App\Models\Culture;
use Maatwebsite\Excel\Concerns\FromCollection;

class CultureExport implements FromCollection
{
    public function collection()
    {
        return Culture::all();
    }
}
