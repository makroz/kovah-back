<?php

namespace App\Exports;

use App\Models\Report;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReportExport implements FromCollection
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
    return User::whereBetween('birth_date', [$this->report->date_from, $this->report->date_to])->orderBy('birth_date', 'desc')->get();
  }
}