<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommentPuan extends Model
{
    protected $table = "comment_puans";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        "comment",
        "dop",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(CommentPuan::class, "user_id", "id");
    }

    public function suarapuan(): BelongsTo
    {
        return $this->belongsTo(SuaraPuan::class, "suarapuan_id", "id");
    }
}
