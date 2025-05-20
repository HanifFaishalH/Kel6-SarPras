<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanModel extends Model
{
    use HasFactory;

    protected $table = 't_laporan_kerusakan';
    protected $primaryKey = 'laporan_id';
    protected $fillable = [
        'user_id',
        'gedung_id',
        'lantai_id',
        'ruang_id',
        'sarana_id',
        'laporan_judul',
        'laporan_foto',
        'tingkat_kerusakan',
        'tingkat_urgensi',
        'frekuensi_penggunaan',
        'tanggal_operasional'
    ];

    public function gedung()
    {
        return $this->belongsTo(GedungModel::class, 'gedung_id', 'gedung_id');
    }
    public function lantai()
    {
        return $this->belongsTo(LantaiModel::class, 'lantai_id', 'lantai_id');
    }
    public function ruang()
    {
        return $this->belongsTo(RuangModel::class, 'ruang_id', 'ruang_id');
    }
    public function sarana()
    {
        return $this->belongsTo(SaranaModel::class, 'sarana_id', 'sarana_id');
    }
    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }
    public function teknisi()
    {
        return $this->belongsTo(TeknisiModel::class, 'teknisi_id', 'teknisi_id');
    }
    public function getStatusAttribute()
    {
        return $this->attributes['status'] ?? 'pending';
    }
}
