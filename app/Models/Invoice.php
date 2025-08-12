<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'client_id',
        'signer_id',
        'invoice_date',
        'due_date',
        'vendor_code',
        'attention_to',
        'attention_name',
        'subtotal',
        'ppn_amount',
        'total_amount',
        'include_ppn',
        'status',
        'notes',
        'pdf_path'
    ];

    protected $casts = [
        'invoice_date' => 'date',
        'due_date' => 'date',
        'include_ppn' => 'boolean',
        'subtotal' => 'decimal:2',
        'ppn_amount' => 'decimal:2',
        'total_amount' => 'decimal:2'
    ];

    // Relationships
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function signer()
    {
        return $this->belongsTo(Employee::class, 'signer_id');
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    // Accessors
    public function getFormattedInvoiceDateAttribute()
    {
        return $this->invoice_date->format('d F Y');
    }

    public function getFormattedDueDateAttribute()
    {
        return $this->due_date->format('d F Y');
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'draft' => 'bg-gray-100 text-gray-800',
            'sent' => 'bg-blue-100 text-blue-800',
            'paid' => 'bg-green-100 text-green-800',
            'overdue' => 'bg-red-100 text-red-800',
            'cancelled' => 'bg-red-100 text-red-800'
        ];

        return $badges[$this->status] ?? 'bg-gray-100 text-gray-800';
    }

    public function getStatusTextAttribute()
    {
        $texts = [
            'draft' => 'Draft',
            'sent' => 'Terkirim',
            'paid' => 'Dibayar',
            'overdue' => 'Terlambat',
            'cancelled' => 'Dibatalkan'
        ];

        return $texts[$this->status] ?? 'Unknown';
    }

    // Scope untuk pencarian
    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('invoice_number', 'like', "%{$search}%")
              ->orWhereHas('client', function($q) use ($search) {
                  $q->where('name', 'like', "%{$search}%");
              })
              ->orWhereHas('signer', function($q) use ($search) {
                  $q->where('name', 'like', "%{$search}%");
              });
        });
    }

    // Generate nomor invoice otomatis
    public static function generateInvoiceNumber()
    {
        $year = date('Y');
        $month = date('m');
        
        // Cari nomor invoice terakhir untuk bulan dan tahun ini
        $lastInvoice = self::where('invoice_number', 'like', "%/INV-RSI/{$month}/{$year}")
                          ->orderBy('invoice_number', 'desc')
                          ->first();
        
        if ($lastInvoice) {
            // Extract nomor urut dari nomor invoice terakhir
            preg_match('/^(\d+)\/INV-RSI/', $lastInvoice->invoice_number, $matches);
            $lastSequence = intval($matches[1]);
            $sequence = $lastSequence + 1;
        } else {
            $sequence = 1;
        }
        
        return sprintf('%03d/INV-RSI/%s/%s', $sequence, $month, $year);
    }

    // Calculate totals
    public function calculateTotals()
    {
        $subtotal = $this->items->sum('total_price');
        $this->subtotal = $subtotal;
        
        if ($this->include_ppn) {
            // PPN 12% dari DPP (11/12 dari total)
            $dpp = $subtotal * (11/12);
            $this->ppn_amount = $dpp * 0.12;
        } else {
            $this->ppn_amount = 0;
        }
        
        $this->total_amount = $subtotal + $this->ppn_amount;
        $this->save();
    }
}
