<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model {
    use HasFactory;

    protected $fillable = [
        'kode_transaksi',
        'user_id',
        'slot_id',
        'status',
        'jam_masuk',
        'jam_keluar',
    ];

    public function slot() {
        return $this->belongsTo(Slot::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
