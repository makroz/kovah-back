<?php

namespace App\Listeners;

use App\Event\ReportCreated;
use App\Jobs\CreateReportJob;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateReport
{
  /**
   * Create the event listener.
   *
   * @return void
   */
  public function __construct()
  {
    //
  }

  /**
   * Handle the event.
   *
   * @param  \App\Event\ReportCreated  $event
   * @return void
   */
  public function handle(ReportCreated $event)
  {
    $ReportJob = new CreateReportJob($event->report);
    Dispatch($ReportJob);
  }
}