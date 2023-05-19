<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = [
        'facility_category_id',
        'name',
    ];


    public function category()
    {
        return $this->belongsTo(FacilityCategory::class, 'facility_category_id');
    }


    public function properties()
    {
        return $this->belongsToMany(Property::class);
    }
}
