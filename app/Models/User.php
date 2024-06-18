<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Rackbeat\UIAvatars\HasAvatar;

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable, HasAvatar;

    protected $fillable = [
        'name',
        'email',
        'password',
        'level',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAvatar($size = 128) {
        return $this->getGravatar($this->email, $size);
    }

    public function saldo() {
        return $this->hasOne(Saldo::class);
    }

    public function pembayaran() {
        return $this->hasMany(Pembayaran::class);
    }

    public function transaksi() {
        return $this->hasMany(Transaksi::class);
    }
}
