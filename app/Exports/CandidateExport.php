<?php

namespace App\Exports;

use App\Models\Profile;

use Illuminate\Support\Facades\Request;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutosize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;


class CandidateExport implements FromCollection, ShouldAutosize, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection(): \Illuminate\Support\Collection
    {
        return Profile::all();
    }

    protected int $index = 0;

    public function map($row): array
    {
        $createdAtFormat = date('d-m-Y', strtotime($row->created_at));

        return [
            ++$this->index,
            $row->id,
            $row->gender,
            $row->phone,
            $row->address,
            $row->bio,
            $row->experience,
            $createdAtFormat
        ];
    }

    public function headings(): array
    {
        return [
            'S.No',
            'ID',
            'Gender',
            'Phone',
            'Address',
            'Bio',
            'Experience',
            'Created At'
        ];
    }
}
