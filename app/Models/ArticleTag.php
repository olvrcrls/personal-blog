<?php

namespace App\Models;

use App\Base\BaseModel;

class ArticleTag extends BaseModel
{
    // Start something amazing...
    public function taggable
    {
        return $this->morphTo()
    }
}
