<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'path',
        'alt',
        'sort_order',
        'is_logo',
    ];

    protected $casts = [
        'is_logo' => 'boolean',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}

