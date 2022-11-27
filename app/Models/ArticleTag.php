<?php

namespace App\Models;

use App\Base\BaseModel;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ArticleTag extends BaseModel
{
    /**
     * Polymorphic model relationship
     */
    public function taggable(): MorphTo
    {
        return $this->morphTo();
    }
}
