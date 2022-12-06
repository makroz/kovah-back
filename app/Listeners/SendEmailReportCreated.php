<?php

namespace App\Listeners;

use App\Event\ReportCreated;
use App\Mail\CreateReportMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailReportCreated implements ShouldQueue
{

  public $afterCommit = true;
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
    $email = new CreateReportMail($event->report);
    Mail::to('johndoe@tests.com')->send($email);
  }
}