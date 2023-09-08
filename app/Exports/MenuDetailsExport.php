<?php

namespace App\Exports;

use App\Models\MenuDetails;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MenuDetailsExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(MenuDetails::getMenuDetails());
    }

    public function headings():array{
        return [
            'Id',
            'Menu Item',
            'Cost in INR',
            'Category'
        ];
    }
}
