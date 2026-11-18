<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bike extends Model
{
    use HasFactory;

    protected $fillable = [
        'serial_number',
        'model',
        'price_per_hour',
        'status',
    ];

    protected $casts = [
        'price_per_hour' => 'decimal:2',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // Relación N:M indirecta con usuarios a través de 'bookings'
    public function users()
    {
        return $this->belongsToMany(User::class, 'bookings')
                    ->withPivot('start_time', 'end_time')
                    ->withTimestamps();
    }
}
