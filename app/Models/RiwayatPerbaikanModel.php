<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPerbaikanModel extends Model
{
    use HasFactory;

    protected $table = 't_riwayat_perbaikan';
    protected $primaryKey = 'riwayat_id';

    protected $fillable = [
        'laporan_id',
        'teknisi_id',
        'tindakan',
        'bahan',
        'biaya',
        'status',
        'waktu_mulai',
        'waktu_selesai',
    ];

    protected $dates = [
        'waktu_mulai',
        'waktu_selesai',
        'created_at',
        'updated_at',
    ];

    // Relationship with LaporanModel
    public function laporan()
    {
        return $this->belongsTo(LaporanModel::class, 'laporan_id', 'laporan_id');
    }

    // Relationship with TeknisiModel
    public function teknisi()
    {
        return $this->belongsTo(TeknisiModel::class, 'teknisi_id', 'teknisi_id');
    }
}