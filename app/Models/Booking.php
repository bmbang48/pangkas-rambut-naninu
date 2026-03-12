<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //


    public $timestamps = false;

    protected $table = 'bookings';
    protected $primaryKey = 'id';

    protected $fillable = [
        'barber_id',
        'service_id',
        'customer_name',
        'phone',
        'booking_date',
        'booking_time',
        'notes',
        'status'
    ];

    public function barber()
    {
        return $this->belongsTo(Barber::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
