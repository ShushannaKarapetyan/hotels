<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Hotel extends Model
{
    protected $fillable = [
        'type_id',
        'name',
        'email',
        'phone',
        'address',
    ];

    protected $with = ['type'];

    /**
     * @return BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(HotelType::class);
    }

    /**
     * @return HasMany
     */
    public function rooms()
    {
        return $this->hasMany(HotelRoom::class);
    }
}
