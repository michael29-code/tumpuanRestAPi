<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Role extends Model
{
    protected $table = "roles";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;


    protected $fillable = [
        'nama_role',
        'deskripsi'
    ];

    // public function user(): BelongsTo
    // {
    //     return $this->belongsTo(Role::class, "user_id", "id");
    // }
}
