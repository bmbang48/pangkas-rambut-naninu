<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barber extends Model
{
    //

    public $timestamps = false;

    protected $table = 'barbers';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'photo',
        'experience'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
