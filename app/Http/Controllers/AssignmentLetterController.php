<?php

namespace App\Http\Controllers;

use App\Models\AssignmentLetter;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class AssignmentLetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $status = $request->get('status');
        
        $letters = AssignmentLetter::with(['signer', 'assignedTo']);
        
        if ($search) {
            $letters->search($search);
        }
        
        if ($status && $status !== 'all') {
            $letters->where('status', $status);
        }
        
        $letters = $letters->orderBy('created_at', 'desc')->paginate(10);
        
        return view('dashboard.assignment-letters.index', compact('letters', 'search', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::where('status', 'active')->orderBy('name')->get();
        return view('dashboard.assignment-letters.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'signer_id' => 'required|exists:employees,id',
            'assigned_to_id' => 'required|exists:employees,id',
            'assignment_description' => 'required|string',
            'assignment_date' => 'required|date',
            'start_date' => 'nullable|date|after_or_equal:assignment_date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'location' => 'required|string|max:255',
            'status' => 'required|in:draft,active,completed,cancelled'
        ]);

        $data = $request->all();
        $data['letter_number'] = AssignmentLetter::generateLetterNumber();
        
        $letter = AssignmentLetter::create($data);

        return redirect()->route('assignment-letters.index')->with('success', 'Surat tugas berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $letter = AssignmentLetter::with(['signer', 'assignedTo'])->findOrFail($id);
        return view('dashboard.assignment-letters.show', compact('letter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $letter = AssignmentLetter::findOrFail($id);
        $employees = Employee::where('status', 'active')->orderBy('name')->get();
        return view('dashboard.assignment-letters.edit', compact('letter', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $letter = AssignmentLetter::findOrFail($id);
        
        $request->validate([
            'signer_id' => 'required|exists:employees,id',
            'assigned_to_id' => 'required|exists:employees,id',
            'assignment_description' => 'required|string',
            'assignment_date' => 'required|date',
            'start_date' => 'nullable|date|after_or_equal:assignment_date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'location' => 'required|string|max:255',
            'status' => 'required|in:draft,active,completed,cancelled'
        ]);

        $letter->update($request->all());

        return redirect()->route('assignment-letters.index')->with('success', 'Surat tugas berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $letter = AssignmentLetter::findOrFail($id);
        
        // Delete PDF file if exists
        if ($letter->pdf_path && Storage::exists($letter->pdf_path)) {
            Storage::delete($letter->pdf_path);
        }
        
        $letter->delete();

        return redirect()->route('assignment-letters.index')->with('success', 'Surat tugas berhasil dihapus!');
    }

    /**
     * Generate PDF for the assignment letter
     */
    public function generatePdf(string $id)
    {
        $letter = AssignmentLetter::with(['signer', 'assignedTo'])->findOrFail($id);
        
        // Generate PDF
        $pdf = PDF::loadView('dashboard.assignment-letters.pdf', compact('letter'));
        $pdf->setPaper('A4', 'portrait');
        
        // Save PDF to storage
        $filename = 'surat_tugas_' . str_replace(['/', '\\'], '_', $letter->letter_number) . '_' . date('Y-m-d_H-i-s') . '.pdf';
        $path = 'assignment-letters/' . $filename;
        
        Storage::put('public/' . $path, $pdf->output());
        
        // Update letter with PDF path
        $letter->update(['pdf_path' => $path]);
        
        return $pdf->download($filename);
    }

    /**
     * Download existing PDF
     */
    public function downloadPdf(string $id)
    {
        $letter = AssignmentLetter::findOrFail($id);
        
        if (!$letter->pdf_path || !Storage::exists('public/' . $letter->pdf_path)) {
            return redirect()->back()->with('error', 'File PDF tidak ditemukan!');
        }
        
        return Storage::download('public/' . $letter->pdf_path);
    }
}
