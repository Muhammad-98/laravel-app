<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = array('street','building','floor','apartment','landmark');

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
