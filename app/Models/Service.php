<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //
    public $timestamps = false;

    protected $table = 'services';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'duration',
        'price'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
