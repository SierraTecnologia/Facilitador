<?php

namespace Facilitador\Models;

use DB;
use App;
use URL;
use Facilitador;
use Event;
use Config;
use Session;
use FacilitadorURL;
use Bkwld\Cloner\Cloneable;
use Bkwld\Upchuck\SupportsUploads;
use Bkwld\Library\Utils\Collection;
use Exception;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Facilitador\Collections\Base as BaseCollection;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Audit\Traits\Loggable;

abstract class Base extends \Support\Models\Base
{

    /**
     * Adding common traits.  The memory usage of adding additional methods is
     * negligible.
     */
    use Cloneable,
        Sluggable,
        SluggableScopeHelpers,
        SupportsUploads,
        \Support\Traits\Models\CanSerializeTransform,
        \Support\Traits\Models\Exportable,
        Loggable
    ;

    /**
     * Use the Decoy Base Collection
     *
     * @param  array $models
     * @return Images
     */
    public function newCollection(array $models = [])
    {
        return new BaseCollection($models);
    }

    /**
     * Disable mutators unless the active request isn't for the admin, the key
     * doesn't reference a true database-backed attribute, or the key was
     * expressly whitelisted in the admin_mutators property.
     *
     * @param  string $key
     * @return mixed
     */
    public function hasGetMutator($key)
    {
        if (!Facilitador::handling()
            || !array_key_exists($key, $this->attributes)
            || in_array($key, $this->admin_mutators)
        ) {
            return parent::hasGetMutator($key);
        }
    }

    /**
     * Disable mutators unless the active request isn't for the admin, the key
     * doesn't reference a true database-backed attribute, or the key was
     * expressly whitelisted in the admin_mutators property.
     *
     * @param  string $key
     * @return mixed
     */
    public function hasSetMutator($key)
    {
        if (!Facilitador::handling()
            || !array_key_exists($key, $this->attributes)
            || in_array($key, $this->admin_mutators)
        ) {
            return parent::hasSetMutator($key);
        }
    }

    //---------------------------------------------------------------------------
    // Instantiation
    //---------------------------------------------------------------------------

    /**
     * Constructor registers events and configures mass assignment
     */
    public function __construct(array $attributes = [])
    {
        // Remove any settings that affect JSON conversion (visible / hidden) and
        // mass assignment protection (fillable / guarded) while in the admin
        if (Facilitador::handling()) {
            $this->visible = $this->hidden = $this->fillable = $this->guarded = [];
        }

        // Continue Laravel construction
        parent::__construct($attributes);
    }

    //---------------------------------------------------------------------------
    // Slug creation via cviebrock/eloquent-sluggable
    //---------------------------------------------------------------------------

    /**
     * Tell sluggable where to get the source for the slug and apply other
     * customizations.
     *
     * @return array
     */
    public function sluggable()
    {
        if (!$this->needsSlugging()) { return [];
        }
        return [
            'slug' => [
                'source' => 'admin_title',
                'maxLength' => 100,
                'includeTrashed' => true,
            ]
        ];
    }

    /**
     * Make the visibility state action
     *
     * @param  array $data The data passed to a listing view
     * @return string
     */
    protected function makeVisibilityAction($data)
    {
        extract($data);

        // Check if this model supports editing the visibility
        if ($many_to_many
            || !app('facilitador.user')->can('publish', $controller)
            || !array_key_exists('public', $this->attributes)
        ) {
            return;
        }

        // Create the markup
        $public = $this->getAttribute('public');
        return sprintf(
            '<a class="visibility js-tooltip" data-placement="left" title="%s">
                <span class="glyphicon glyphicon-eye-%s"></span>
            </a>',
            $public ? __('facilitador::base.standard_list.private') : __('facilitador::base.standard_list.publish'),
            $public ? 'open' : 'close'
        );
    }

    /**
     * Make the edit or view action.
     *
     * @param  array $data The data passed to a listing view
     * @return string
     */
    protected function makeEditAction($data)
    {
        extract($data);

        // Make markup
        $editable = app('facilitador.user')->can('update', $controller);
        return sprintf(
            '<a href="%s" class="action-edit js-tooltip"
            data-placement="left" title="%s">
                <span class="glyphicon glyphicon-%s"></span>
            </a>',
            $this->getAdminEditUri($controller, $many_to_many), // URL
            $editable ? // Label
                __('facilitador::base.action.edit') :
                __('facilitador::base.action.read'),
            $editable ? 'pencil' : 'zoom-in' // Icon
        );
    }

    /**
     * Get the admin edit URL assuming you know the controller and whether it's
     * being listed as a many to many
     *
     * @param  string  $controller   ex: Admin\ArticlesController
     * @param  boolean $many_to_many
     * @return string
     */
    public function getAdminEditUri($controller, $many_to_many = false)
    {
        if ($many_to_many) {
            return URL::to(FacilitadorURL::action($controller.'@edit', $this->getKey()));
        }

        return URL::to(FacilitadorURL::relative('edit', $this->getKey(), $controller));
    }

    /**
     * Make the view action
     *
     * @param  array $data The data passed to a listing view
     * @return string
     */
    protected function makeViewAction($data)
    {
        if (!$uri = $this->getUriAttribute()) {
            return;
        }

        return sprintf(
            '<a href="%s" target="_blank" class="action-view js-tooltip"
            data-placement="left" title="' . __('facilitador::base.action.view') . '">
                <span class="glyphicon glyphicon-bookmark"></span>
            </a>', $uri
        );
    }

    /**
     * Make the delete action
     *
     * @param  array $data The data passed to a listing view
     * @return string
     */
    protected function makeDeleteAction($data)
    {
        extract($data);

        // Check if this model can be deleted.  This mirrors code found in the table
        //  partial for generating the edit link on the title
        if (!(app('facilitador.user')->can('destroy', $controller)
            || ($many_to_many && app('facilitador.user')->can('update', $parent_controller)))
        ) {
            return;
        }

        // If soft deleted, show a disabled icon
        if (method_exists($this, 'trashed') && $this->trashed()) {
            return '<span class="glyphicon glyphicon-trash"></span>';
        }

        // Make the label
        $label = $many_to_many ?
            __('facilitador::base.action.remove') :
            $with_trashed ?
                __('facilitador::base.action.soft_delete') :
                __('facilitador::base.action.delete');

        // Return markup
        return sprintf(
            '<a class="%s js-tooltip" data-placement="left" title="%s">
                <span class="glyphicon glyphicon-%s"></span>
            </a>',
            $many_to_many ? 'remove-now' : 'delete-now',
            $label,
            $many_to_many ? 'remove' : 'trash'
        );
    }

    //---------------------------------------------------------------------------
    // Scopes
    //---------------------------------------------------------------------------


    /**
     * Filter by the current locale
     *
     * @param  Illuminate\Database\Query\Builder $query
     * @param  string                            $locale
     * @return Illuminate\Database\Query\Builder
     */
    public function scopeLocalize($query, $locale = null)
    {
        return $query->where('locale', $locale ?: Facilitador::locale());
    }

    /**
     * Fire an Decoy model event.
     *
     * @param  $string event The name of this event
     * @param  $array  args  An array of params that will be passed to the handler
     * @return object
     */
    public function fireDecoyEvent($event, $args = null)
    {
        $event = "facilitador::model.{$event}: ".get_class($this);

        return Event::dispatch($event, $args);
    }
    
}
