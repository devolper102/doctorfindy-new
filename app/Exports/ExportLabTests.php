<?php

namespace App\Exports;

use App\Speciality_Test;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportLabTests implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Speciality_Test::all();
    }
}
