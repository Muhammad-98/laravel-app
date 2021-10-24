<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $fillable = array('name','city_id','has_addresses');

    public function address()
    {
        return $this->hasMany(Address::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
