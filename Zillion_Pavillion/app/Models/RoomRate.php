<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomRate extends Model
{
    use HasFactory;

    protected $table = 'room_rates';

    protected $fillable = [
        'room_id',
        'name',
        'price',
        'currency',
        'effective_from',
        'effective_to',
        'is_default',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_default' => 'boolean',
        'effective_from' => 'date',
        'effective_to' => 'date',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
