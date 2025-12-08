<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'room_number',
        'name',
        'type',
        'description',
        'price_per_night',
        'max_occupancy',
        'bed_count',
        'bed_type',
        'size_sqm',
        'amenities',
        'images',
        'view_type',
        'is_available',
        'floor_number',
    ];

    protected $casts = [
        'amenities' => 'array',
        'images' => 'array',
        'price_per_night' => 'decimal:2',
        'size_sqm' => 'decimal:2',
        'is_available' => 'boolean',
    ];
}
