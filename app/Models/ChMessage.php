<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Chatify\Traits\UUID;
use Spatie\Translatable\HasTranslations;

class ChMessage extends Model
{
    use UUID, HasTranslations;

    protected array $translatable = [
        'name',
    ];
}
