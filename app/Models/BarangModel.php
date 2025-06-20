<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangModel extends Model
{
    use HasFactory;

    protected $table = 'm_barang';
    protected $primaryKey = 'barang_id';
    protected $fillable = [
        'kategori_id',
        'barang_nama',
        'spesifikasi',
    ];
    
    public $timestamps = true;

    public function kategori()
    {
        return $this->belongsTo(KategoriModel::class, 'kategori_id', 'kategori_id');
    }
    public function sarana()
    {
        return $this->hasMany(SaranaModel::class, 'barang_id', 'barang_id');
    }
}



