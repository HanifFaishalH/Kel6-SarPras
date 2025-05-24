<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LantaiModel extends Model
{
    use HasFactory;

    protected $table = 'm_lantai';
    protected $primaryKey = 'lantai_id';
    protected $fillable = [
        'lantai_nama',
        'lantai_kode',
        'gedung_id',
    ];
    public $timestamps = true;

    public function ruang()
    {
        return $this->hasMany(RuangModel::class, 'lantai_id', 'lantai_id');
    }
}
