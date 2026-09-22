<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with(['images', 'logos'])->latest()->get();
        return view('dashboard.services.index', compact('services'));
    }

    public function publicShow(Service $service)
    {
        $service->load(['images', 'logos']);
        return view('services.show', compact('service'));
    }

    public function create()
    {
        return view('dashboard.services.create');
    }

    public function store(Request $request)
    {
        $uploadedOriginalNames = [];

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'service_type' => 'required|in:managed_service,infrastruktur_teknologi,web_software_development,cloud_hosting',
            'description' => 'required|string',
            'excerpt' => 'nullable|string',
            'label' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
            'catalog_file' => 'nullable|file|mimes:pdf|max:10240',
            'links_text' => 'nullable|string',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'logos' => 'nullable|array',
            'logos.*' => 'image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        ]);

        $validated['extra_links'] = $this->parseLinksText($request->input('links_text'));
        unset($validated['links_text']);

        if ($request->hasFile('image')) {
            if (!$request->file('image')->isValid()) {
                return back()->withErrors(['image' => 'Upload gambar cover gagal. Silakan coba lagi.'])->withInput();
            }
            $uploadedOriginalNames[] = 'cover: ' . $request->file('image')->getClientOriginalName();
            $validated['image'] = $request->file('image')->store('services', 'public');
            $this->syncPublicStorageFile($validated['image']);
        }

        if ($request->hasFile('catalog_file')) {
            if (!$request->file('catalog_file')->isValid()) {
                return back()->withErrors(['catalog_file' => 'Upload katalog gagal. Silakan coba lagi.'])->withInput();
            }
            $uploadedOriginalNames[] = 'catalog: ' . $request->file('catalog_file')->getClientOriginalName();
            $validated['catalog_file'] = $request->file('catalog_file')->store('services/catalogs', 'public');
            $this->syncPublicStorageFile($validated['catalog_file']);
        }

        $service = Service::create($validated);

        if ($request->hasFile('gallery')) {
            $sort = 0;
            foreach ($request->file('gallery') as $file) {
                if (!$file || !$file->isValid()) {
                    continue;
                }
                $uploadedOriginalNames[] = 'gallery: ' . $file->getClientOriginalName();
                $path = $file->store('services/gallery', 'public');
                $this->syncPublicStorageFile($path);
                ServiceImage::create([
                    'service_id' => $service->id,
                    'path' => $path,
                    'alt' => $service->title,
                    'sort_order' => $sort++,
                    'is_logo' => false,
                ]);
            }
        }

        if ($request->hasFile('logos')) {
            $maxLogoSort = (int) ($service->logos()->max('sort_order') ?? -1);
            $logoSort = $maxLogoSort + 1;
            foreach ($request->file('logos') as $file) {
                if (!$file || !$file->isValid()) {
                    continue;
                }
                $uploadedOriginalNames[] = 'logo: ' . $file->getClientOriginalName();
                $path = $file->store('services/logos', 'public');
                $this->syncPublicStorageFile($path);
                ServiceImage::create([
                    'service_id' => $service->id,
                    'path' => $path,
                    'alt' => $service->title,
                    'sort_order' => $logoSort++,
                    'is_logo' => true,
                ]);
            }
        }

        return redirect()
            ->route('services.index')
            ->with('success', 'Layanan berhasil ditambahkan.')
            ->with('uploaded_files', $uploadedOriginalNames);
    }

    public function edit(Service $service)
    {
        $service->load(['images', 'logos']);
        return view('dashboard.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $uploadedOriginalNames = [];

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'service_type' => 'required|in:managed_service,infrastruktur_teknologi,web_software_development,cloud_hosting',
            'description' => 'required|string',
            'excerpt' => 'nullable|string',
            'label' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
            'catalog_file' => 'nullable|file|mimes:pdf|max:10240',
            'links_text' => 'nullable|string',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'logos' => 'nullable|array',
            'logos.*' => 'image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'delete_gallery_ids' => 'nullable|array',
            'delete_gallery_ids.*' => 'integer',
            'delete_logo_ids' => 'nullable|array',
            'delete_logo_ids.*' => 'integer',
        ]);

        $validated['extra_links'] = $this->parseLinksText($request->input('links_text'));
        unset($validated['links_text']);

        if ($request->hasFile('image')) {
            if (!$request->file('image')->isValid()) {
                return back()->withErrors(['image' => 'Upload gambar cover gagal. Silakan coba lagi.'])->withInput();
            }
            // Hapus gambar lama jika ada
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
                $this->deleteMirroredPublicFile($service->image);
            }
            $uploadedOriginalNames[] = 'cover: ' . $request->file('image')->getClientOriginalName();
            $validated['image'] = $request->file('image')->store('services', 'public');
            $this->syncPublicStorageFile($validated['image']);
        }

        if ($request->hasFile('catalog_file')) {
            if (!$request->file('catalog_file')->isValid()) {
                return back()->withErrors(['catalog_file' => 'Upload katalog gagal. Silakan coba lagi.'])->withInput();
            }
            if ($service->catalog_file) {
                Storage::disk('public')->delete($service->catalog_file);
                $this->deleteMirroredPublicFile($service->catalog_file);
            }
            $uploadedOriginalNames[] = 'catalog: ' . $request->file('catalog_file')->getClientOriginalName();
            $validated['catalog_file'] = $request->file('catalog_file')->store('services/catalogs', 'public');
            $this->syncPublicStorageFile($validated['catalog_file']);
        }

        $service->update($validated);

        if ($request->filled('delete_gallery_ids')) {
            $ids = array_values(array_unique($request->input('delete_gallery_ids', [])));
            $images = $service->images()->whereIn('id', $ids)->get();
            foreach ($images as $img) {
                Storage::disk('public')->delete($img->path);
                $this->deleteMirroredPublicFile($img->path);
                $img->delete();
            }
        }

        if ($request->filled('delete_logo_ids')) {
            $logoIds = array_values(array_unique($request->input('delete_logo_ids', [])));
            $logos = $service->logos()->whereIn('id', $logoIds)->get();
            foreach ($logos as $logo) {
                Storage::disk('public')->delete($logo->path);
                $this->deleteMirroredPublicFile($logo->path);
                $logo->delete();
            }
        }

        if ($request->hasFile('gallery')) {
            $maxSort = (int) ($service->images()->max('sort_order') ?? -1);
            $sort = $maxSort + 1;
            foreach ($request->file('gallery') as $file) {
                if (!$file || !$file->isValid()) {
                    continue;
                }
                $uploadedOriginalNames[] = 'gallery: ' . $file->getClientOriginalName();
                $path = $file->store('services/gallery', 'public');
                $this->syncPublicStorageFile($path);
                ServiceImage::create([
                    'service_id' => $service->id,
                    'path' => $path,
                    'alt' => $service->title,
                    'sort_order' => $sort++,
                    'is_logo' => false,
                ]);
            }
        }

        if ($request->hasFile('logos')) {
            $maxLogoSort = (int) ($service->logos()->max('sort_order') ?? -1);
            $logoSort = $maxLogoSort + 1;
            foreach ($request->file('logos') as $file) {
                if (!$file || !$file->isValid()) {
                    continue;
                }
                $uploadedOriginalNames[] = 'logo: ' . $file->getClientOriginalName();
                $path = $file->store('services/logos', 'public');
                $this->syncPublicStorageFile($path);
                ServiceImage::create([
                    'service_id' => $service->id,
                    'path' => $path,
                    'alt' => $service->title,
                    'sort_order' => $logoSort++,
                    'is_logo' => true,
                ]);
            }
        }

        return redirect()
            ->route('services.index')
            ->with('success', 'Layanan berhasil diupdate.')
            ->with('uploaded_files', $uploadedOriginalNames);
    }

    public function show(Service $service)
    {
        // Resource route exists; keep admin UX consistent by going to edit.
        return redirect()->route('services.edit', $service);
    }

    public function destroy(Service $service)
    {
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
            $this->deleteMirroredPublicFile($service->image);
        }
        if ($service->catalog_file) {
            Storage::disk('public')->delete($service->catalog_file);
            $this->deleteMirroredPublicFile($service->catalog_file);
        }

        $service->load(['images', 'logos']);
        foreach ($service->images as $img) {
            Storage::disk('public')->delete($img->path);
            $this->deleteMirroredPublicFile($img->path);
        }
        foreach ($service->logos as $logo) {
            Storage::disk('public')->delete($logo->path);
            $this->deleteMirroredPublicFile($logo->path);
        }

        $service->delete();
        return redirect()->route('services.index')->with('success', 'Layanan berhasil dihapus.');
    }

    private function syncPublicStorageFile(string $relativePath): void
    {
        // Kalau public/storage sudah terhubung ke storage/app/public (symlink/junction), tidak perlu mirror.
        $publicStorage = @realpath(public_path('storage'));
        $appPublic = @realpath(storage_path('app/public'));
        if ($publicStorage && $appPublic && $publicStorage === $appPublic) {
            return;
        }

        // Kalau public/storage bukan link (folder biasa), mirror agar file bisa diakses publik.
        $source = Storage::disk('public')->path($relativePath);
        $dest = public_path('storage/' . ltrim(str_replace('\\', '/', $relativePath), '/'));

        if (!is_file($source)) {
            return;
        }

        $destDir = dirname($dest);
        if (!is_dir($destDir)) {
            @mkdir($destDir, 0775, true);
        }

        @copy($source, $dest);
    }

    private function deleteMirroredPublicFile(string $relativePath): void
    {
        $publicStorage = @realpath(public_path('storage'));
        $appPublic = @realpath(storage_path('app/public'));
        if ($publicStorage && $appPublic && $publicStorage === $appPublic) {
            return;
        }

        $dest = public_path('storage/' . ltrim(str_replace('\\', '/', $relativePath), '/'));
        if (is_file($dest)) {
            @unlink($dest);
        }
    }

    private function parseLinksText(?string $linksText): array
    {
        if (!$linksText) {
            return [];
        }

        $lines = preg_split('/\r\n|\r|\n/', trim($linksText)) ?: [];
        $links = [];

        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '') {
                continue;
            }

            $label = '';
            $url = '';

            if (str_contains($line, '|')) {
                [$label, $url] = array_map('trim', explode('|', $line, 2));
            } else {
                // Jika user hanya input URL saja (contoh: mugglecloud.com)
                $url = $line;
            }

            if ($url === '') {
                continue;
            }

            // Banyak user input tanpa skema (contoh: tokopedia.com/xxx). Kita normalisasi dulu.
            if (!preg_match('/^[a-z][a-z0-9+.-]*:\/\//i', $url)) {
                $url = 'https://' . ltrim($url, '/');
            }

            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                continue;
            }

            if ($label === '') {
                $host = (string) (parse_url($url, PHP_URL_HOST) ?? '');
                $label = $host !== '' ? preg_replace('/^www\./i', '', $host) : $url;
            }

            $links[] = ['label' => $label, 'url' => $url];
        }

        return $links;
    }
}
