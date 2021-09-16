<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = array('name','state_id');
    
    public function areas()
    {
        return $this->hasMany(Area::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

}
