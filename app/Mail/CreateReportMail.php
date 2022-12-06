<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CreateReportMail extends Mailable
{
  use Queueable, SerializesModels;


  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct()
  {
  }

  public function build()
  {
    return $this->view('mail.createreport');
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