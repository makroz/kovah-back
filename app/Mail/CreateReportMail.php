<?php

namespace App\Mail;

use App\Models\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CreateReportMail extends Mailable
{
  use Queueable, SerializesModels;

  public $report;
  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct(Report $report)
  {
    $this->report = $report;
  }

  public function build()
  {
    return $this->view('mail.createreport', ['data' => $this->report]);
  }

  /**
   * Get the attachments for the message.
   *
   * @return array
   */
  public function attachments()
  {
    return [];
  }
}