<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Manager extends Model
{
    use Notifiable;

    protected $fillable = [
        'hotel_id',
        'email',
    ];

    /**
     * @return BelongsTo
     */
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
