<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Mail\CreateReportMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class CreateReportJob implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  public $to;
  /**
   * Create a new job instance.
   *
   * @return void
   */
  public function __construct($to)
  {
    $this->to = $to;
  }

  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle()
  {
    $email = new CreateReportMail();
    Mail::to('johndoe@tests.com')->send($email);
  }
}