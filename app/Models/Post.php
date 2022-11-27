<?php

namespace App\Models;

use App\Base\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends BaseModel
{
    /**
     * Author of the post
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Alias function for the user relationship
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->user();
    }
}
