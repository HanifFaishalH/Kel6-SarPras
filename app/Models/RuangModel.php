<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuangModel extends Model
{
    use HasFactory;

    protected $table = 'm_ruang';
    protected $primaryKey = 'ruang_id';
    protected $fillable = [
        'ruang_nama',
        'ruang_kode',
        'lantai_id',
    ];
    public $timestamps = true;

    public function lantai()
    {
        return $this->belongsTo(LantaiModel::class, 'lantai_id', 'lantai_id');
    }

}
