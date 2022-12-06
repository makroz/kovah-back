<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Report;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class ReportExport implements FromCollection, WithHeadings, WithColumnWidths
{

  public $report;

  /**
   * @return \Illuminate\Support\Collection
   */
  public function __construct(Report $report)
  {
    $this->report = $report;
  }

  /**
   * @return \Illuminate\Support\Collection
   */
  public function collection()
  {
    return User::select(['id', 'name', 'email', 'birth_date'])->whereBetween('birth_date', [$this->report->date_from, $this->report->date_to])->orderBy('birth_date', 'asc')->get();
  }

  public function headings(): array
  {
    return [
      ['REPORTE de usuarios que nacieron entre: ' . $this->report->date_from . ' y ' . $this->report->date_to], [
        'ID',
        'NAME',
        'EMAIL',
        'BIRTHDAY'
      ]
    ];
  }

  public function columnWidths(): array
  {
    return [
      'A' => 7,
      'B' => 40,
      'C' => 40,
      'D' => 12,
    ];
  }
}