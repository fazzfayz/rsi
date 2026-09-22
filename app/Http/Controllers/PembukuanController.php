<?php

namespace App\Http\Controllers;

use App\Models\Pembukuan;
use App\Models\PembukuanItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembukuanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $pembukuans = Pembukuan::when($search, function ($q) use ($search) {
            $q->where('nama_project', 'like', "%{$search}%");
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('dashboard.pembukuan.index', compact('pembukuans', 'search'));
    }

    public function create()
    {
        return view('dashboard.pembukuan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_project' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date|after_or_equal:tanggal_mulai',
            'income' => 'nullable|numeric|min:0',
            'items' => 'required|array|min:1',
            'items.*.nama_barang' => 'required|string|max:255',
            'items.*.quantity' => 'required|numeric|min:0.01',
            'items.*.harga_barang' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            $totalJumlah = 0;
            foreach ($request->items as $it) {
                $qty = (float) $it['quantity'];
                $harga = (float) $it['harga_barang'];
                $totalJumlah += round($qty * $harga, 2);
            }

            $income = (float) ($request->income ?? 0);
            $selisih = $income - $totalJumlah;
            $selisihStatus = $income > $totalJumlah ? 'profit' : ($income < $totalJumlah ? 'loss' : 'nihil');

            $pembukuan = Pembukuan::create([
                'nama_project' => $request->nama_project,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_berakhir' => $request->tanggal_berakhir,
                'total_jumlah' => round($totalJumlah, 2),
                'income' => $income,
                'selisih' => abs(round($selisih, 2)),
                'selisih_status' => $selisihStatus,
            ]);

            foreach ($request->items as $it) {
                $qty = (float) $it['quantity'];
                $harga = (float) $it['harga_barang'];
                PembukuanItem::create([
                    'pembukuan_id' => $pembukuan->id,
                    'nama_barang' => $it['nama_barang'],
                    'quantity' => $qty,
                    'harga_barang' => $harga,
                    'total' => round($qty * $harga, 2),
                ]);
            }

            DB::commit();

            return redirect()->route('pembukuan.index')
                ->with('success', 'Pembukuan berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show(Pembukuan $pembukuan)
    {
        $pembukuan->load('items');
        return view('dashboard.pembukuan.show', compact('pembukuan'));
    }

    public function edit(Pembukuan $pembukuan)
    {
        $pembukuan->load('items');
        return view('dashboard.pembukuan.edit', compact('pembukuan'));
    }

    public function update(Request $request, Pembukuan $pembukuan)
    {
        $request->validate([
            'nama_project' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date|after_or_equal:tanggal_mulai',
            'income' => 'nullable|numeric|min:0',
            'items' => 'required|array|min:1',
            'items.*.nama_barang' => 'required|string|max:255',
            'items.*.quantity' => 'required|numeric|min:0.01',
            'items.*.harga_barang' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            $totalJumlah = 0;
            foreach ($request->items as $it) {
                $qty = (float) $it['quantity'];
                $harga = (float) $it['harga_barang'];
                $totalJumlah += round($qty * $harga, 2);
            }

            $income = (float) ($request->income ?? 0);
            $selisih = $income - $totalJumlah;
            $selisihStatus = $income > $totalJumlah ? 'profit' : 'loss';

            $pembukuan->update([
                'nama_project' => $request->nama_project,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_berakhir' => $request->tanggal_berakhir,
                'total_jumlah' => round($totalJumlah, 2),
                'income' => $income,
                'selisih' => abs(round($selisih, 2)),
                'selisih_status' => $selisihStatus,
            ]);

            $pembukuan->items()->delete();
            foreach ($request->items as $it) {
                $qty = (float) $it['quantity'];
                $harga = (float) $it['harga_barang'];
                PembukuanItem::create([
                    'pembukuan_id' => $pembukuan->id,
                    'nama_barang' => $it['nama_barang'],
                    'quantity' => $qty,
                    'harga_barang' => $harga,
                    'total' => round($qty * $harga, 2),
                ]);
            }

            DB::commit();

            return redirect()->route('pembukuan.index')
                ->with('success', 'Pembukuan berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy(Pembukuan $pembukuan)
    {
        try {
            $pembukuan->delete();
            return redirect()->route('pembukuan.index')
                ->with('success', 'Pembukuan berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function pdf(Pembukuan $pembukuan)
    {
        $pembukuan->load('items');

        $pdf = Pdf::loadView('dashboard.pembukuan.pdf', compact('pembukuan'));

        $san = fn ($s) => preg_replace('/[\/\\\\:*?"<>|]/', '-', (string) $s);
        $filename = 'Laporan Pembukuan - ' . $san($pembukuan->nama_project) . '.pdf';

        return $pdf->download($filename);
    }
}
