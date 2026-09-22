<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    // Masukkan SEMUA nama kolom tabel di sini agar bisa disimpan
    protected $fillable = [
        'name',
        'contact_person', // Wajib ada
        'jabatan',
        'address',
        'join_year',      // WAJIB ADA (Solusi Error Gambar 10)
        'phone',
        'email',
        'description',
        'status',         // Wajib ada
    ];

    public function purchaseOrders()
    {
        return $this->hasMany(\App\Models\PurchaseOrder::class, 'vendor_id');
    }
}