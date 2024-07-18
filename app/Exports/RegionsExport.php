<?php

namespace App\Exports;

use App\Models\Region;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;


class RegionsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Region::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nom',
            'Créé le',
            'Mis à jour le',
        ];
    }
}
