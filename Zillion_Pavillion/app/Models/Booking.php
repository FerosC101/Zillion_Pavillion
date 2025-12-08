<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'room_id',
        'check_in_date',
        'check_out_date',
        'number_of_rooms',
        'adults',
        'children',
        'room_type',
        'event_type',
        'event_date',
        'event_time',
        'venue',
        'guest_count',
        'total_amount',
        'paid_amount',
        'status',
        'notes',
        'special_requests',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'date',
            'event_time' => 'datetime',
            'total_amount' => 'decimal:2',
            'paid_amount' => 'decimal:2',
            'guest_count' => 'integer',
        ];
    }

    /**
     * Get the client that owns the booking.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the room for the booking.
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Get the services for the booking.
     */
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'booking_services')
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }
}
