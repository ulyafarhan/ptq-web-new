<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['title', 'slug', 'content', 'status', 'published_at', 'user_id'];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(400)
            ->format('webp')
            ->nonQueued();
            
        $this->addMediaConversion('banner')
            ->width(1200)
            ->format('webp')
            ->nonQueued();
    }
    
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}