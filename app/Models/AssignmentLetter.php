<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AssignmentLetter extends Model
{
    use HasFactory;

    protected $fillable = [
        'letter_number',
        'signer_id',
        'assigned_to_id',
        'assignment_description',
        'assignment_date',
        'start_date',
        'end_date',
        'location',
        'status',
        'pdf_path'
    ];

    protected $casts = [
        'assignment_date' => 'date',
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    // Relationships
    public function signer()
    {
        return $this->belongsTo(Employee::class, 'signer_id');
    }

    public function assignedTo()
    {
        return $this->belongsTo(Employee::class, 'assigned_to_id');
    }

    // Accessors
    public function getFormattedAssignmentDateAttribute()
    {
        return $this->assignment_date->format('d F Y');
    }

    public function getFormattedStartDateAttribute()
    {
        return $this->start_date ? $this->start_date->format('d F Y') : '-';
    }

    public function getFormattedEndDateAttribute()
    {
        return $this->end_date ? $this->end_date->format('d F Y') : '-';
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'draft' => 'bg-gray-100 text-gray-800',
            'active' => 'bg-blue-100 text-blue-800',
            'completed' => 'bg-green-100 text-green-800',
            'cancelled' => 'bg-red-100 text-red-800'
        ];

        return $badges[$this->status] ?? 'bg-gray-100 text-gray-800';
    }

    public function getStatusTextAttribute()
    {
        $texts = [
            'draft' => 'Draft',
            'active' => 'Aktif',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan'
        ];

        return $texts[$this->status] ?? 'Unknown';
    }

    // Scope untuk pencarian
    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('letter_number', 'like', "%{$search}%")
              ->orWhereHas('signer', function($q) use ($search) {
                  $q->where('name', 'like', "%{$search}%");
              })
              ->orWhereHas('assignedTo', function($q) use ($search) {
                  $q->where('name', 'like', "%{$search}%");
              });
        });
    }

    // Generate nomor surat otomatis
    public static function generateLetterNumber()
    {
        $year = date('Y');
        $month = date('m');
        
        // Cari nomor surat terakhir untuk bulan dan tahun ini
        $lastLetter = self::where('letter_number', 'like', "%/ST-RSI/{$month}/{$year}")
                          ->orderBy('letter_number', 'desc')
                          ->first();
        
        if ($lastLetter) {
            // Extract nomor urut dari nomor surat terakhir
            preg_match('/^(\d+)\/ST-RSI/', $lastLetter->letter_number, $matches);
            $lastSequence = intval($matches[1]);
            $sequence = $lastSequence + 1;
        } else {
            $sequence = 1;
        }
        
        return sprintf('%03d/ST-RSI/%s/%s', $sequence, $month, $year);
    }
}
