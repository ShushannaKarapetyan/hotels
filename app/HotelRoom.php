<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class HotelRoom extends Model
{
    protected $fillable = [
        'hotel_id',
        'name',
        'adults',
        'children',
    ];

   protected $with = ['freeRoom'];

    /**
     * @return BelongsTo
     */
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    /**
     * @return HasMany
     */
    public function freeRoom()
    {
        return $this->hasMany(FreeRoom::class, 'room_id');
    }
}
