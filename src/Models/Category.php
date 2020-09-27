<?php

namespace Facilitador\Models;

use Facilitador\Facades\Facilitador;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Translation\Traits\HasTranslations;

class Category extends Model
{
    use SoftDeletes;
    use HasTranslations;

    protected $table = 'categories';

    /**
     * @var string[]
     *
     * @psalm-var array{0: string, 1: string}
     */
    protected array $translatable = ['slug', 'name'];

    /**
     * @var string[]
     *
     * @psalm-var array{0: string, 1: string}
     */
    protected $fillable = ['slug', 'name'];

    /**
     * @var string[]
     *
     * @psalm-var array{0: string}
     */
    protected $dates = ['deleted_at'];

    /**
     * @var string[]
     *
     * @psalm-var array{0: string}
     */
    protected $guarded  = array('id');
    

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @psalm-return \Illuminate\Database\Eloquent\Relations\BelongsTo<self>
     */
    public function parentId(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(self::class);
    }


    /**
     * Returns a formatted post content entry,
     * this ensures that line breaks are returned.
     *
     * @return string
     */
    public function description()
    {
        return nl2br($this->description);
    }

    /**
     * Get the author.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @psalm-return \Illuminate\Database\Eloquent\Relations\BelongsTo<User>
     */
    public function author(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the slider's images.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * @psalm-return \Illuminate\Database\Eloquent\Relations\HasMany<Article>
     */
    public function articles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Article::class, 'article_category_id');
    }

    /**
     * Get the slider's images.
     *
     * @return array
     */
    public function posts()
    {
        return $this->hasMany(Facilitador::modelClass('Post'))
            ->published()
            ->orderBy('created_at', 'DESC');
    }

    /**
     * Get the category's language.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @psalm-return \Illuminate\Database\Eloquent\Relations\BelongsTo<Language>
     */
    public function language(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Language::class, 'language_code');
    }
}
