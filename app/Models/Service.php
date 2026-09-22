<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'service_type',
        'description',
        'excerpt',
        'label',
        'image',
        'catalog_file',
        'extra_links',
        'slug',
    ];

    protected $casts = [
        'extra_links' => 'array',
    ];

    public function images()
    {
        return $this->hasMany(ServiceImage::class)
            ->where('is_logo', false)
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    public function logos()
    {
        return $this->hasMany(ServiceImage::class)
            ->where('is_logo', true)
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    protected static function booted(): void
    {
        static::saving(function (self $service) {
            if (!$service->slug && $service->title) {
                $service->slug = static::generateUniqueSlug($service->title, $service->id);
            }

            if (!$service->excerpt && $service->description) {
                $service->excerpt = Str::limit(trim(strip_tags($service->description)), 160);
            }
        });
    }

    public static function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title);
        $slug = $base ?: Str::random(8);

        $i = 2;
        while (static::query()
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->where('slug', $slug)
            ->exists()
        ) {
            $slug = $base . '-' . $i;
            $i++;
        }

        return $slug;
    }
}
