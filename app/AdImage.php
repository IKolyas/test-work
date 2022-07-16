<?php

namespace App;

use Illuminate\Database\Eloquent\Model,
    Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdImage extends Model
{
    protected $fillable = [
        'ad_id',
        'url',
        'priority',
    ];

    protected $hidden = [
        'updated_at',
        'updated_at',
    ];

    public function ad(): BelongsTo
    {
        return $this->belongsTo(Ad::class);
    }
}
