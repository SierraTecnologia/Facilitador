<?php

namespace Facilitador\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{

    /**
     * The controller class name. Ex: Admin\PostsController
     *
     * @var string
     */
    protected $controller;

    /**
     * The HTML title, shown in header of the vie. Ex: News Posts
     *
     * @var string
     */
    protected $title;

    /**
     * The text description of what this controller manages, shown in the header.
     * Ex: "Relevant news about the brand"
     *
     * @var string
     */
    protected $description;

    //---------------------------------------------------------------------------
    // Constructing
    //---------------------------------------------------------------------------

    /**
     * A view instance to use as the layout
     *
     * @var Illuminate\Contracts\View\Factory
     */
    protected $layout;

    /**
     * Populate protected properties on init
     */
    public function __construct()
    {
        // Set the layout from the Config file
        $this->layout = View::make(config('sitec.core.layout'));

        // Store the controller class for routing
        $this->controller = get_class($this);

        // Get the controller name
        $controller_name = $this->controllerName($this->controller);

        // Make a default title based on the controller name
        if (empty($this->title)) {
            $this->title = $this->title($controller_name);
        }
    }


    /**
     * Pass controller properties that are used by the layout and views through
     * to the view layer
     *
     * @param  mixed                $content string view name or an HtmlObject / View object
     * @param  array                $vars    Key value pairs passed to the content view
     * @return Illuminate\View\View
     */
    protected function populateView($content, $vars = [])
    {
        // The view
        if (is_string($content)) {
            $this->layout->content = View::make($content);
        } else {
            $this->layout->content = $content;
        }

        // Set vars
        $this->layout->title = $this->title();
        $this->layout->description = $this->description();
        View::share('controller', $this->controller);

        // Make sure that the content is a Laravel view before applying vars.
        // to it.  In the case of the index view, `content` is a Fields\Listing
        // instance, not a Laravel view
        if (is_a($this->layout->content, 'Illuminate\View\View')) {
            $this->layout->content->with($vars);
        }

        // Return the layout View
        return $this->layout;
    }
}