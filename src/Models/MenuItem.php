<?php

namespace Facilitador\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Facilitador\Facades\Facilitador;
use Translation\Traits\HasTranslations;

class MenuItem extends Model
{
    use HasTranslations;

    /**
     * @var string[]
     *
     * @psalm-var array{link: string}
     */
    protected array $translatorMethods = [
        'link' => 'translatorLink',
    ];

    protected string $table = 'menu_items';

    /**
     * @var array
     */
    protected array $guarded = [];

    /**
     * @var string[]
     *
     * @psalm-var array{0: string}
     */
    protected array $translatable = ['title'];

    public static function boot()
    {
        parent::boot();

        static::created(
            function ($model) {
                $model->menu->removeMenuFromCache();
            }
        );

        static::saved(
            function ($model) {
                $model->menu->removeMenuFromCache();
            }
        );

        static::deleted(
            function ($model) {
                $model->menu->removeMenuFromCache();
            }
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * @psalm-return \Illuminate\Database\Eloquent\Relations\HasMany<TRelatedModel>
     */
    public function children(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Facilitador::modelClass('MenuItem'), 'parent_id')
            ->with('children')
            ->orderBy('order');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @psalm-return \Illuminate\Database\Eloquent\Relations\BelongsTo<Model>
     */
    public function menu(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Facilitador::modelClass('Menu'));
    }

    public function link($absolute = false)
    {
        return $this->prepareLink($absolute, $this->route, $this->parameters, $this->url);
    }

    public function translatorLink($translator, $absolute = false)
    {
        return $this->prepareLink($absolute, $translator->route, $translator->parameters, $translator->url);
    }

    protected function prepareLink($absolute, $route, $parameters, $url)
    {
        if (is_null($parameters)) {
            $parameters = [];
        }

        if (is_string($parameters)) {
            $parameters = json_decode($parameters, true);
        } elseif (is_array($parameters)) {
            $parameters = $parameters;
        } elseif (is_object($parameters)) {
            $parameters = json_decode(json_encode($parameters), true);
        }

        if (!is_null($route)) {
            if (!Route::has($route)) {
                return '#';
            }

            return route($route, $parameters, $absolute);
        }

        if ($absolute) {
            return url($url);
        }

        return $url;
    }

    public function getParametersAttribute()
    {
        return json_decode($this->attributes['parameters']);
    }

    public function setParametersAttribute($value): void
    {
        if (is_array($value)) {
            $value = json_encode($value);
        }

        $this->attributes['parameters'] = $value;
    }

    public function setUrlAttribute($value): void
    {
        if (is_null($value)) {
            $value = '';
        }

        $this->attributes['url'] = $value;
    }

    /**
     * Return the Highest Order Menu Item.
     *
     * @param number $parent (Optional) Parent id. Default null
     *
     * @return int Order number
     */
    public function highestOrderMenuItem($parent = null): int
    {
        $order = 1;

        $item = $this->where('parent_id', '=', $parent)
            ->orderBy('order', 'DESC')
            ->first();

        if (!is_null($item)) {
            $order = intval($item->order) + 1;
        }

        return $order;
    }
}
