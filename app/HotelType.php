<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HotelType extends Model
{
    protected $fillable = [
        'type',
    ];

    /**
     * @return HasMany
     */
    public function hotels()
    {
        return $this->hasMany(Hotel::class, 'type_id');
    }
}
