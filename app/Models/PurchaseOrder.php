<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'po_number',
        'po_date',
        'ref_number',
        'vendor_id',
        'vendor_name',
        'vendor_address',
        'vendor_email',
        'vendor_contact_person',
        'ship_to_company',
        'ship_to_address',
        'attention_to',
        'attention_name',
        'subtotal',
        'vat_amount',
        'total_amount',
        'notes',
        'status',
        'created_by',
        'approved_by',
        'approved_at',
        'signatory_employee_id'
    ];

    protected $casts = [
        'po_date' => 'date',
        'approved_at' => 'datetime',
        'subtotal' => 'decimal:2',
        'vat_amount' => 'decimal:2',
        'total_amount' => 'decimal:2'
    ];

    // Relationships
    public function vendor()
    {
        return $this->belongsTo(Client::class, 'vendor_id');
    }

    public function items()
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function signatoryEmployee()
    {
        return $this->belongsTo(Employee::class, 'signatory_employee_id');
    }

    // Accessors
    public function getFormattedPoDateAttribute()
    {
        return $this->po_date->format('d F Y');
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'draft' => 'bg-gray-100 text-gray-800',
            'pending' => 'bg-yellow-100 text-yellow-800',
            'approved' => 'bg-green-100 text-green-800',
            'cancelled' => 'bg-red-100 text-red-800'
        ];

        return $badges[$this->status] ?? 'bg-gray-100 text-gray-800';
    }

    public function getStatusTextAttribute()
    {
        $texts = [
            'draft' => 'Draft',
            'pending' => 'Menunggu',
            'approved' => 'Disetujui',
            'cancelled' => 'Dibatalkan'
        ];

        return $texts[$this->status] ?? 'Unknown';
    }

    // Scope untuk pencarian
    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('po_number', 'like', "%{$search}%")
              ->orWhere('vendor_name', 'like', "%{$search}%")
              ->orWhere('ref_number', 'like', "%{$search}%");
        });
    }

    // Generate nomor PO otomatis
    public static function generatePoNumber()
    {
        $year = date('Y');
        $month = date('m');
        
        // Cari nomor PO terakhir untuk bulan dan tahun ini
        $lastPo = self::where('po_number', 'like', "%/RSI.PO/{$month}/{$year}")
                     ->orderBy('po_number', 'desc')
                     ->first();
        
        if ($lastPo) {
            // Extract nomor urut dari nomor PO terakhir
            preg_match('/^(\d+)\/RSI\.PO/', $lastPo->po_number, $matches);
            $lastSequence = intval($matches[1]);
            $sequence = $lastSequence + 1;
        } else {
            $sequence = 1;
        }
        
        return sprintf('%03d/RSI.PO/%s/%s', $sequence, $month, $year);
    }

    // Calculate totals
    public function calculateTotals()
    {
        $subtotal = $this->items->sum('total_price');
        $this->subtotal = $subtotal;
        
        // VAT 12%
        $this->vat_amount = $subtotal * 0.12;
        
        $this->total_amount = $subtotal + $this->vat_amount;
        $this->save();
    }

    // Get formatted amounts
    public function getFormattedSubtotalAttribute()
    {
        return number_format($this->subtotal, 0, ',', '.');
    }

    public function getFormattedVatAmountAttribute()
    {
        return number_format($this->vat_amount, 0, ',', '.');
    }

    public function getFormattedTotalAmountAttribute()
    {
        return number_format($this->total_amount, 0, ',', '.');
    }
} 