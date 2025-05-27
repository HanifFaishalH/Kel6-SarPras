<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SarPrasModel extends Model
{
    use HasFactory;

    protected $primaryKey = 'sarPras_id';

    protected $table = 'm_saranaprasarana';

    protected $fillable = [
        'level_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}