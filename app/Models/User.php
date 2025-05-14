<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements AuthenticatableContract
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Kolom yang bisa diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
        'level_id',
        'no_induk',
        'nama',
        'unit',
        'expertise',
    ];

    /**
     * Kolom yang disembunyikan saat serialisasi.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Tipe data yang perlu dikonversi otomatis.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    /**
     * Override default key login dari email ke username.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    /**
     * Jika ingin tetap bisa akses name untuk auth display.
     * Misalnya Auth::user()->name
     */
    public function getNameAttribute()
    {
        return $this->attributes['nama'];
    }
}
