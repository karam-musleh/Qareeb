<?php

namespace App\Mail;

use App\Models\Initiative;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InitiativeApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Initiative $initiative) {}

    public function build(): self
    {
        return $this->subject('تمت الموافقة على مبادرتك')
                    ->view('emails.initiatives.approved');
    }
}
