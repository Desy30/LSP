<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuthorModel extends Model
{
    protected $table = 'Author';

    protected $fillable = [
        'user_id',
        'phone_number',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,
            'user_id', 'id');
    }
}
