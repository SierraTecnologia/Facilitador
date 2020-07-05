<?php

namespace Facilitador\Models;

use Illuminate\Database\Eloquent\Model;
use Facilitador\Facades\Facilitador;
use RicardoSierra\Translation\Traits\HasTranslations;

class Category extends Model
{
    use HasTranslations;

    protected $translatable = ['slug', 'name'];

    protected $table = 'categories';

    protected $fillable = ['slug', 'name'];

    public function posts()
    {
        return $this->hasMany(Facilitador::modelClass('Post'))
            ->published()
            ->orderBy('created_at', 'DESC');
    }

    public function parentId()
    {
        return $this->belongsTo(self::class);
    }
}
