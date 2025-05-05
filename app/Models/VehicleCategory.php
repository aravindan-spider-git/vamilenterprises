<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * A vehicle category belongs to a vehicle.
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
