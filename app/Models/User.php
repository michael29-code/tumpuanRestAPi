<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model implements Authenticatable
{
    protected $table = "users";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        'username',
        'email',
        'password',
        'gender',
        'dob',
        'role_id',
        'name'
    ];
    public function kontak_amen(): HasMany
    {
        return $this->hasMany(KontakAman::class, "user_id", "id");
    }

    public function suarapuan(): HasMany
    {
        return $this->hasMany(SuaraPuan::class, "user_id", "id");
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class, "user_id", "id");
    }

    public function catatan_haid(): BelongsTo
    {
        return $this->belongsTo(CatatanHaid::class, "user_id", "id");
    }


    // public function role(): BelongsTo
    // {
    //     return $this->belongsTo(User::class, "user_id", "id");
    // }


    // public function role(): BelongsTo
    // {
    //     return $this->belongsTo(User::class, "user_id", "id");
    // }

    public function getAuthIdentifierName()
    {
        return 'username';
    }

    public function getAuthIdentifier()
    {
        return $this->username;
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->token;
    }

    public function setRememberToken($value)
    {
        $this->token = $value;
    }

    public function getRememberTokenName()
    {
        return 'token';
    }
}
