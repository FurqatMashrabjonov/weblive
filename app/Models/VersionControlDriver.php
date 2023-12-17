<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VersionControlDriver extends Model
{
    protected $fillable = [
        'user_id',
        'driver',
        'driver_id',
        'token',
        'refresh_token',
        'expires_in',
        'nickname',
        'name',
        'email',
        'avatar',
        'user',
    ];

    protected $casts = [
        'user' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
