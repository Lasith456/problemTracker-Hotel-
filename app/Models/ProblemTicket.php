<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProblemTicket extends Model
{
    protected $fillable = [
        'ticket_id', 'status', 'hotel_id', 'department_id',
        'guest_name', 'guest_contact', 'room_no',
        'check_in_date', 'check_out_date',
        'problem_description',
        'problem_type_id', 'problem_area_id', 'notification_source_id',
        'action_taken', 'actioned_at',
        'follow_up', 'followed_up_at',
        'compensation', 'amount', 'compensation_given_at',
        'updated_by','confirmation_number','email','followed_up_by','entered_by',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function problemType()
    {
        return $this->belongsTo(ProblemType::class);
    }

    public function problemArea()
    {
        return $this->belongsTo(ProblemArea::class);
    }

    public function notificationSource()
    {
        return $this->belongsTo(NotificationSource::class);
    }

    public function updatedByUser()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // ✅ Add this new relationship
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
