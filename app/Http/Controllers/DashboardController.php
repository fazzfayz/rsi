<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Client;
use App\Models\User;
use App\Models\Employee;
use App\Models\AssignmentLetter;
use App\Models\Invoice;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            [
                'label' => 'Total Layanan',
                'value' => Service::count(),
                'icon' => 'fas fa-cogs',
                'icon_color' => 'text-blue-600',
                'bg' => 'bg-blue-100',
            ],
            [
                'label' => 'Total Client',
                'value' => Client::count(),
                'icon' => 'fas fa-users',
                'icon_color' => 'text-green-600',
                'bg' => 'bg-green-100',
            ],
            [
                'label' => 'Total Karyawan',
                'value' => Employee::count(),
                'icon' => 'fas fa-user-tie',
                'icon_color' => 'text-orange-600',
                'bg' => 'bg-orange-100',
            ],
            [
                'label' => 'Karyawan Aktif',
                'value' => Employee::where('status', 'active')->count(),
                'icon' => 'fas fa-user-check',
                'icon_color' => 'text-green-600',
                'bg' => 'bg-green-100',
            ],
            [
                'label' => 'Total User',
                'value' => User::count(),
                'icon' => 'fas fa-user',
                'icon_color' => 'text-purple-600',
                'bg' => 'bg-purple-100',
            ],
            [
                'label' => 'Total Surat Tugas',
                'value' => AssignmentLetter::count(),
                'icon' => 'fas fa-file-alt',
                'icon_color' => 'text-indigo-600',
                'bg' => 'bg-indigo-100',
            ],
            [
                'label' => 'Surat Aktif',
                'value' => AssignmentLetter::where('status', 'active')->count(),
                'icon' => 'fas fa-file-check',
                'icon_color' => 'text-green-600',
                'bg' => 'bg-green-100',
            ],
            [
                'label' => 'Total Invoice',
                'value' => Invoice::count(),
                'icon' => 'fas fa-file-invoice',
                'icon_color' => 'text-purple-600',
                'bg' => 'bg-purple-100',
            ],
            [
                'label' => 'Invoice Dibayar',
                'value' => Invoice::where('status', 'paid')->count(),
                'icon' => 'fas fa-money-bill-wave',
                'icon_color' => 'text-green-600',
                'bg' => 'bg-green-100',
            ],
        ];

        // Data untuk dashboard
        $recentEmployees = Employee::latest()->take(5)->get();
        $employeesByDepartment = Employee::selectRaw('department, count(*) as total')
            ->groupBy('department')
            ->orderBy('total', 'desc')
            ->get();
        $employeesByStatus = Employee::selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->get();
        
        // Data surat tugas
        $recentAssignmentLetters = AssignmentLetter::with(['signer', 'assignedTo'])
            ->latest()
            ->take(5)
            ->get();
        $assignmentLettersByStatus = AssignmentLetter::selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->get();
        
        // Data invoice
        $recentInvoices = Invoice::with(['client', 'signer'])
            ->latest()
            ->take(5)
            ->get();
        $invoicesByStatus = Invoice::selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->get();

        return view('dashboard', compact('stats', 'recentEmployees', 'employeesByDepartment', 'employeesByStatus', 'recentAssignmentLetters', 'assignmentLettersByStatus', 'recentInvoices', 'invoicesByStatus'));
    }

    public function refreshSession()
    {
        // Update last activity
        session(['last_activity' => time()]);
        
        return response()->json(['success' => true]);
    }
}
