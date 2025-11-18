<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Structure extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'name', 'position', 'group_type', 
        'division_name', 'level', 'sort_order', 'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'level' => 'integer',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        // Optimize for HDD: Auto convert to WebP & Resize
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(300)
            ->sharpen(10)
            ->format('webp') 
            ->nonQueued(); // Execute immediately (careful on HDD, but needed for simplicity)
    }
}