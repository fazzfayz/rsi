<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembukuan extends Model
{
    use HasFactory;

    protected $table = 'pembukuans';

    protected $fillable = [
        'nama_project',
        'tanggal_mulai',
        'tanggal_berakhir',
        'total_jumlah',
        'income',
        'selisih',
        'selisih_status',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_berakhir' => 'date',
        'total_jumlah' => 'decimal:2',
        'income' => 'decimal:2',
        'selisih' => 'decimal:2',
    ];

    public function items()
    {
        return $this->hasMany(PembukuanItem::class);
    }

    public function getFormattedTanggalMulaiAttribute()
    {
        return $this->tanggal_mulai->format('d/m/Y');
    }

    public function getFormattedTanggalBerakhirAttribute()
    {
        return $this->tanggal_berakhir->format('d/m/Y');
    }

    public function getFormattedTotalJumlahAttribute()
    {
        return number_format($this->total_jumlah, 0, ',', '.');
    }

    public function getFormattedIncomeAttribute()
    {
        return number_format($this->income, 0, ',', '.');
    }

    public function getFormattedSelisihAttribute()
    {
        return number_format(abs($this->selisih), 0, ',', '.');
    }

    public function getSelisihLabelAttribute()
    {
        if ($this->selisih_status === 'profit') {
            return 'Profit Rp ' . $this->formatted_selisih;
        }
        if ($this->selisih_status === 'loss') {
            return 'Loss Rp ' . $this->formatted_selisih;
        }
        if ($this->selisih_status === 'nihil') {
            return 'Nihil Rp ' . $this->formatted_selisih;
        }
    }
}
