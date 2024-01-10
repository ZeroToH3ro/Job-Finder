<?php

namespace App\Exports;

use App\Models\Company;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EmployersExport implements FromCollection, ShouldAutoSize, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Company::all();
    }

    protected int $index = 0;

    public function map($row): array
    {
        $createdAtFormat = date('d-m-Y', strtotime($row->created_at));

        return [
            ++$this->index,
            $row->id,
            $row->cname,
            $row->slug,
            $row->phone,
            $row->website,
            $row->sologan,
            $row->address,
            $createdAtFormat
        ];
    }

    public function headings(): array
    {
        return [
            'S.No',
            'ID',
            'Name',
            'Slug',
            'Phone',
            'Website',
            'Sologan',
            'Address',
            'Created At'
        ];
    }

}
