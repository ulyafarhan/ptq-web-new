<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Program extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'title', 'description', 'schedule', 'location', 
        'type', 'status', 'is_active'
    ];

    // Casting tipe data agar otomatis jadi boolean
    protected $casts = [
        'is_active' => 'boolean',
    ];
}