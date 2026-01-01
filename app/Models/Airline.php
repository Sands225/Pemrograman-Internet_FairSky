<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Airline extends Model
{
    public function airplanes(): HasMany
    {
        return $this->hasMany(Airplane::class);
    }
}
