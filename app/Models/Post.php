<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Post extends Pivot
{
    use HasFactory;
    

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
