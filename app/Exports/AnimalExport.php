<?php
namespace App\Exports;

use App\Models\Animal;
use Maatwebsite\Excel\Concerns\FromCollection;

class AnimalExport implements FromCollection
{
    public function collection()
    {
        return Animal::all();
    }
}
