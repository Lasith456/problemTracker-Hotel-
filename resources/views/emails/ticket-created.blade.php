@component('mail::message')
# New Problem Ticket Created

**Ticket ID:** {{ $ticket->ticket_id }}  
**Hotel/Branch:** {{ $ticket->hotel->name }}  
**Department:** {{ $ticket->department->name }}  
**Description:** {{ $ticket->problem_description }}

@component('mail::button', ['url' => route('tickets.show', $ticket->id)])
View Ticket
@endcomponent

### ⚠️ *This is an automated message. Please do not reply to this email.*

@endcomponent
