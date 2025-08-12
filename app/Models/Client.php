<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'join_year',
        'phone',
        'email',
        'description',
        'status'
    ];

    protected $casts = [
        'join_year' => 'integer',
    ];

    public function getJoinYearFormattedAttribute()
    {
        return $this->join_year;
    }

    public function getStatusBadgeAttribute()
    {
        return $this->status === 'active' 
            ? '<span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Aktif</span>'
            : '<span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Tidak Aktif</span>';
    }
}
