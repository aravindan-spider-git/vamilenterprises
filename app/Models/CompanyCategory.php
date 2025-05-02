<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'company_id',
    ];

    // Each category belongs to one company
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
