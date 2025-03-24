<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class UsersExport implements FromCollection, WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return User::all();
        return User::select('name', 'email')->get();
    }
    public function headings(): array
    {
        return [
            'Name',
            'Email',
        ];
    }

    public function styles($sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12, 'color' => ['rgb' => 'FFFFFF']]], // Row 1 (Headers) - Bold & White Color
            'A1:B1' => [
                'fill' => [
                    // 'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'fillType' => Fill::FILL_GRADIENT_LINEAR,
                    // 'rotation' => 90,
                    'startColor' => ['rgb' => '0073AA'], // Blue Background
                    // 'startColor' => ['rgb' => '0073AA'], // Blue Background
                    // 'endColor' => ['rgb' => '0073AA'], // Blue Background
                ],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
            ],
        ];
    }
}
