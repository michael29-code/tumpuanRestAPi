<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CatatanHaid extends Model
{
    protected $primaryKey = "id";
    protected $keyType = "int";
    protected $table = "catatan_haids";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        "start_date",
        "end_date",
        "cycle_length",
        "period_length",
        "start_prediction_date",
        "end_prediction_date",
        "status",
        "reminder_active",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(CatatanHaid::class, "user_id", "id");
    }
}
