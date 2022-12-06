<?php

namespace App\Jobs;

use App\Exports\ReportExport;
use Illuminate\Bus\Queueable;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateReportJob implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  public $report;
  /**
   * Create a new job instance.
   *
   * @return void
   */
  public function __construct($report)
  {
    $this->report = $report;
  }

  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle()
  {
    $reportName = 'excel/report' . $this->report->id . '.xlsx';
    $name = Excel::store(new ReportExport($this->report), $reportName);
    $this->report->report_link = asset($reportName);
    $this->report->save();
  }
}