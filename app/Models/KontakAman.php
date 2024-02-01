<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KontakAman extends Model
{
    protected $primaryKey = "id";
    protected $keyType = "int";
    protected $table = "kontak_amen";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        "name",
        "phoneNumber",
        "relation",
        "kategori_id"
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(KontakAman::class, "user_id", "id");
    }
}
