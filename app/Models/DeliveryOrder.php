<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DeliveryOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'do_number',
        'client_id',
        'delivery_date',
        'carrier_employee_id',
        'signer_employee_id',
        'receiver_name',
        'shipping_address',
        'attention_to',
        'notes',
        'pdf_path'
    ];

    protected $casts = [
        'delivery_date' => 'date',
    ];

    // Relationships
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function items()
    {
        return $this->hasMany(DeliveryOrderItem::class);
    }

    public function carrierEmployee()
    {
        return $this->belongsTo(Employee::class, 'carrier_employee_id');
    }

    public function signerEmployee()
    {
        return $this->belongsTo(Employee::class, 'signer_employee_id');
    }

    // Accessors
    public function getFormattedDeliveryDateAttribute()
    {
        return $this->delivery_date->format('d F Y');
    }

    /** Konversi bulan (1–12) ke Romawi */
    public static function monthToRoman(int $month): string
    {
        $map = [1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI',
                7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'];
        return $map[$month] ?? (string) $month;
    }

    /**
     * Generate nomor surat jalan otomatis.
     * Format: {nomor}/DO-RSI/{bulan_romawi}/{tahun}, contoh: 135/DO-RSI/XII/2025
     *
     * @param \Carbon\Carbon|string|null $date Tanggal referensi (default: sekarang). Pakai delivery_date saat simpan.
     */
    public static function generateDoNumber($date = null): string
    {
        $date = $date ? Carbon::parse($date) : Carbon::now();
        $year = (int) $date->format('Y');
        $month = (int) $date->format('m');
        $roman = self::monthToRoman($month);

        // Get the highest sequence number from all time
        $maxSequence = 0;
        $allDoNumbers = self::pluck('do_number')->toArray();

        foreach ($allDoNumbers as $doNumber) {
            // Extract sequence number from format like "135/DO-RSI/XII/2025"
            $parts = explode('/', $doNumber);
            if (count($parts) >= 1) {
                $sequence = (int) $parts[0];
                $maxSequence = max($maxSequence, $sequence);
            }
        }

        $sequence = $maxSequence + 1;

        return "{$sequence}/DO-RSI/{$roman}/{$year}";
    }
}
