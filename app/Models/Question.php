<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    protected $primaryKey = "id";
    protected $keyType = "int";
    protected $table = "questions";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        "questions",
        "correct_answer",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Question::class, "user_id", "id");
    }
}
