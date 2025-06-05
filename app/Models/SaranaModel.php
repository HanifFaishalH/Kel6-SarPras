<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaranaModel extends Model
{
    use HasFactory;

    protected $table = 'm_sarana';
    protected $primaryKey = 'sarana_id';
    // SaranaModel.php
    protected $fillable = [
        'ruang_id',
        'kategori_id',
        'barang_id',
        'tanggal_operasional',
        'nomor_urut',
        'jumlah_laporan' // Add this line
    ];

    public function ruang()
    {
        return $this->belongsTo(RuangModel::class, 'ruang_id', 'ruang_id');
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriModel::class, 'kategori_id', 'kategori_id');
    }

    public function barang()
    {
        return $this->belongsTo(BarangModel::class, 'barang_id');
    }
}