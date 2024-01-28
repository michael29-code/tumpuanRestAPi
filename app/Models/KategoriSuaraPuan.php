<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriSuaraPuan extends Model
{
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $table = 'kategori_suara_puans';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'nama',
        'deskripsi'
    ];

    public function suaraPuan(): HasMany
    {
        return $this->hasMany(SuaraPuan::class, 'kategori_suara_puan_id', 'id');
    }
}
