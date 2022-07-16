<?php

namespace App;

use Illuminate\Database\Eloquent\Model,
    Illuminate\Database\Eloquent\Relations\HasMany;

class Ad extends Model
{

    protected $fillable = [
        'title',
        'description',
        'price',
        'contacts',
        'created_at',
    ];

    protected $hidden = [
        'updated_at'
    ];

    public function adImages(): HasMany
    {
        return $this->hasMany(AdImage::class);
    }

    public function getBaseImageAttribute(): string
    {
        return $this
            ->adImages()
            ->orderBy('priority', 'ASC')
            ->orderBy('created_at', 'DESC')
            ->first()
            ->url;
    }
}
