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
        'lantai_id',
        'ruang_nama',
        'ruang_kode',
    ];
    public $timestamps = true;

    public function lantai()
    {
        return $this->belongsTo(LantaiModel::class, 'lantai_id', 'lantai_id');
    }

    public function sarana() {
        return $this->hasMany(SaranaModel::class, 'ruang_id');
    }

}
