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
        'role',
        'gedung_id',
        'lantai_id',
        'ruang_id',
        'sarana_id',
        'teknisi_id',
        'laporan_judul',
        'laporan_foto',
        'tingkat_kerusakan',
        'tingkat_urgensi',
        'frekuensi_penggunaan',
        'dampak_kerusakan',
        'tanggal_operasional',
        'status_laporan',
        'tanggal_diproses',
        'tanggal_perbaikan',
        'tanggal_selesai',
        'status_admin',
        'status_sarpras',
    ];

    protected $dates = [
        'tanggal_operasional',
        'tanggal_diproses',
        'tanggal_perbaikan',
        'tanggal_selesai',
        'created_at',
        'updated_at',
    ];

    // Relasi
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

    public function teknisi()
    {
        return $this->belongsTo(TeknisiModel::class, 'teknisi_id', 'teknisi_id');
    }

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }

    // Akses foto lengkap URL
    public function getLaporanFotoAttribute($value)
    {
        if (!$value) return null;
    
        // Remove any duplicate path segments
        $value = str_replace('laporan_files/', '', $value);
        
        // Check if file exists in public path
        $publicPath = public_path('laporan_files/' . $value);
        if (file_exists($publicPath)) {
            return asset('laporan_files/' . $value);
        }
    
    return null; // or return a default image
    }

    public function scopeByUserLevel($query, $userLevel)
    {
        if ($userLevel == 'admin') {
            return $query; // admin lihat semua data
        } elseif ($userLevel == 'sarpras') {
            return $query->where('status_admin', 'disetujui'); // sarpras lihat laporan yang sudah disetujui admin
        } elseif ($userLevel == 'teknisi') {
            // teknisi lihat laporan yang sudah ditugaskan ke teknisi itu sendiri
            return $query->where('teknisi_id', auth()->user()->teknisi->teknisi_id);
        } else {
            // level lain mungkin hanya lihat laporan pelapor sendiri
            return $query->where('user_id', auth()->id());
        }
    }
    public function scopeFilterByStatus($query, $status)
    {
        if ($status) {
            return $query->where('status_laporan', $status);
        }
        return $query;
    }

}
