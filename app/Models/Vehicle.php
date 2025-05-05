<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
         'name', 'registration_number', 'status', 'purchase_date','image','category_id'
    ];

    public function category()
    {
        return $this->belongsTo(VehicleCategory::class, 'category_id');
    }

}

