<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = ['origin', 'destination'];

    public function flights()
    {
        return $this->hasMany(Flight::class);
    }
}
