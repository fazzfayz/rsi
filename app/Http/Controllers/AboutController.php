<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();
        return view('dashboard.about.index', compact('about'));
    }

    public function create()
    {
        return view('dashboard.about.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'list_items' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('about', 'public');
        }
        About::create($validated);
        return redirect()->route('dashboard.about.index')->with('success', 'Tentang Kami berhasil ditambahkan.');
    }

    public function edit(About $about)
    {
        return view('dashboard.about.edit', compact('about'));
    }

    public function update(Request $request, About $about)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'list_items' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->hasFile('image')) {
            if ($about->image) {
                Storage::disk('public')->delete($about->image);
            }
            $validated['image'] = $request->file('image')->store('about', 'public');
        }
        $about->update($validated);
        return redirect()->route('dashboard.about.index')->with('success', 'Tentang Kami berhasil diupdate.');
    }

    public function destroy(About $about)
    {
        if ($about->image) {
            Storage::disk('public')->delete($about->image);
        }
        $about->delete();
        return redirect()->route('dashboard.about.index')->with('success', 'Tentang Kami berhasil dihapus.');
    }

    public function editSingle()
    {
        $about = About::first();
        return view('dashboard.about.edit_single', compact('about'));
    }

    public function updateSingle(Request $request)
    {
        $about = About::first();
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'list_items' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->hasFile('image')) {
            if ($about && $about->image) {
                Storage::disk('public')->delete($about->image);
            }
            $validated['image'] = $request->file('image')->store('about', 'public');
        }
        if ($about) {
            $about->update($validated);
        } else {
            $about = About::create($validated);
        }
        return redirect()->route('dashboard.about.edit')->with('success', 'Tentang Kami berhasil diupdate.');
    }
}
