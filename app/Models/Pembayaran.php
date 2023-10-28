<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model {
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'nominal',
        'snap_token',
        'status',
        'status_code',
        'transaction_status',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
