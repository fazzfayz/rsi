<?php

use App\Models\Service;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Backfill existing rows so public route {service:slug} works immediately.
        // Use chunking to avoid memory spikes.
        Service::query()
            ->where(function ($q) {
                $q->whereNull('slug')->orWhere('slug', '');
            })
            ->orderBy('id')
            ->chunkById(100, function ($services) {
                foreach ($services as $service) {
                    $service->slug = Service::generateUniqueSlug($service->title, $service->id);
                    if (!$service->excerpt && $service->description) {
                        $service->excerpt = \Illuminate\Support\Str::limit(trim(strip_tags($service->description)), 160);
                    }
                    $service->saveQuietly();
                }
            });
    }

    public function down(): void
    {
        // No-op (we don't want to destroy user content).
        DB::table('services')->update(['slug' => null]);
    }
};

