<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::orderBy('created_at', 'desc')->paginate(10);
        $stats = [
            [
                'label' => 'Total Client',
                'value' => Client::count(),
                'icon' => 'fas fa-users',
                'icon_color' => 'text-blue-600',
                'bg' => 'bg-blue-100',
            ],
            [
                'label' => 'Client Aktif',
                'value' => Client::where('status', 'active')->count(),
                'icon' => 'fas fa-check-circle',
                'icon_color' => 'text-green-600',
                'bg' => 'bg-green-100',
            ],
            [
                'label' => 'Tidak Aktif',
                'value' => Client::where('status', 'inactive')->count(),
                'icon' => 'fas fa-times-circle',
                'icon_color' => 'text-red-600',
                'bg' => 'bg-red-100',
            ],
            [
                'label' => 'Bergabung '.date('Y'),
                'value' => Client::where('join_year', date('Y'))->count(),
                'icon' => 'fas fa-calendar-plus',
                'icon_color' => 'text-purple-600',
                'bg' => 'bg-purple-100',
            ],
        ];
        return view('dashboard.clients.index', compact('clients', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'address' => 'required|string',
            'join_year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive'
        ]);

        Client::create($request->all());

        return redirect()->route('clients.index')
            ->with('success', 'Client berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return view('dashboard.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('dashboard.clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'address' => 'required|string',
            'join_year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive'
        ]);

        $client->update($request->all());

        return redirect()->route('clients.index')
            ->with('success', 'Data client berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('clients.index')
            ->with('success', 'Client berhasil dihapus!');
    }
}
