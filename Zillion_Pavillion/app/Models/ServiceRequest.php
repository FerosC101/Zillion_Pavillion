<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    protected $fillable = [
        'client_id',
        'booking_id',
        'service_type',
        'room_number',
        'description',
        'priority',
        'status',
        'requested_at',
        'completed_at',
        'assigned_to',
        'staff_notes',
    ];

    protected $casts = [
        'requested_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'assigned_to');
    }
}
