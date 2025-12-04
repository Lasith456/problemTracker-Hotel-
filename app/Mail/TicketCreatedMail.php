<?php

namespace App\Mail;

use App\Models\ProblemTicket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;

    public function __construct(ProblemTicket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function build()
    {
        return $this->subject("New Problem Ticket: {$this->ticket->ticket_id}")
                    ->markdown('emails.ticket-created');
    }
}
