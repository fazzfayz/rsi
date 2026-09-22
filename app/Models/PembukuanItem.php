<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PembukuanItem extends Model
{
    use HasFactory;

    protected $table = 'pembukuan_items';

    protected $fillable = [
        'pembukuan_id',
        'nama_barang',
        'quantity',
        'harga_barang',
        'total',
    ];

    protected $casts = [
        'quantity' => 'decimal:2',
        'harga_barang' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($item) {
            if (isset($item->quantity) && isset($item->harga_barang)) {
                $item->total = round((float) $item->quantity * (float) $item->harga_barang, 2);
            }
        });
    }

    public function pembukuan(): BelongsTo
    {
        return $this->belongsTo(Pembukuan::class);
    }

    public function getFormattedHargaBarangAttribute()
    {
        return number_format($this->harga_barang, 0, ',', '.');
    }

    public function getFormattedTotalAttribute()
    {
        return number_format($this->total, 0, ',', '.');
    }
}
