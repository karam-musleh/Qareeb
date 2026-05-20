<?php

namespace App\Mail;

use App\Models\Initiative;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InitiativeRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Initiative $initiative,
        public ?string $rejectionReason = null
    ) {}

    public function build(): self
    {
        return $this->subject('تم رفض مبادرتك')
                    ->view('emails.initiatives.rejected');
    }
}
