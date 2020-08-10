<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Webpatser\Uuid\Uuid;

class Hotel extends Model
{
    protected $fillable = [
        'type_id',
        'uuid',
        'name',
        'email',
        'phone',
        'address',
        'rooms_updated_at',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = Uuid::generate(4);
        });
    }

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
        return $this->hasMany(Room::class);
    }

    /**
     * @return HasOne
     */
    public function manager()
    {
        return $this->hasOne(Manager::class);
    }
}
