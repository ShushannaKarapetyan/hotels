<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FreeRoom extends Model
{
    protected $fillable = [
        'room_id',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday',
    ];

    /**
     * @return BelongsTo
     */
    public function room()
    {
        return $this->belongsTo(HotelRoom::class);
    }
}
