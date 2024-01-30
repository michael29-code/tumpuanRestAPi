<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SuaraPuan extends Model
{
    protected $table = "suara_puans";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        "title",
        "content",
        "media",
        "dop",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(SuaraPuan::class, "user_id", "id");
    }

    public function kategorisuarapuan(): BelongsTo
    {
        return $this->belongsTo(KategoriSuaraPuan::class, "kategori_id", "id");
    }

    public function comment(): HasMany
    {
        return $this->hasMany(Comment::class, "suarapuan_id", "id");
    }
}
