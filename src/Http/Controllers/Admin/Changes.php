<?php

namespace Facilitador\Http\Controllers\Decoy;

use Response;
use Facilitador\Models\Change;

/**
 * A log of model changes, used for auditing Admin activity. Can also be used
 * as a source for recovering changed / deleted content.
 */
class Changes extends Base
{
    /**
     * @var string
     */
    protected $title = 'Changes';

    /**
     * @var string
     */
    protected $description = 'A log of actions that can be used to audit <b>Admin</b> activity or recover content.';

    /**
     * @var array
     */
    protected $columns = [
        'Activity' => 'getAdminTitleHtmlAttribute',
    ];

    /**
     * Make search options dependent on whether the site is using roles
     *
     * @return array
     */
    public function search()
    {
        $options = [
            'model' => [
                'label' => __('facilitador::changes.controller.search.type'),
                'type' => 'text',
            ],
            'key' => [
                'label' => __('facilitador::changes.controller.search.key'),
                'type' => 'text',
            ],
            'action' => [
                'label' => __('facilitador::changes.controller.search.action'),
                'type' => 'select',
                'options' => 'Facilitador\Models\Change::getActions()',
            ],
            'title' => [
                'label' => __('facilitador::changes.controller.search.title'),
                'type' => 'text',
            ],
            'admin_id' => [
                'label' => __('facilitador::changes.controller.search.admin'),
                'type' => 'select',
                'options' => 'Facilitador\Models\Change::getAdmins()',
            ],
            'created_at' => [
                'label' => __('facilitador::changes.controller.search.date'),
                'type' => 'date',
            ],
        ];

        return $options;
     }

    /**
     * Only reading is possible
     *
     * @return array An associative array.
     */
    public function getPermissionOptions()
    {
        return [
            'read' => 'View changes of all content',
        ];
    }

    /**
     * Customize the edit view to return the changed attributes as JSON. Using
     * this method / action so that a new routing rule doesn't need to be created
     *
     * @param  int                      $id Model key
     * @return Illuminate\Http\Response
     */
    public function edit($id)
    {
        $change = Change::findOrFail($id);
        $admin = $change->admin;
        return Response::json([
            'action' => __("facilitador::changes.actions.$change->action"),
            'title' => $change->title,
            'admin' => $admin ? $admin->getAdminTitleHtmlAttribute() : 'someone',
            'admin_edit' => $admin ? $admin->getAdminEditAttribute() : null,
            'date' => $change->getHumanDateAttribute(),
            'attributes' => $change->attributesForModal(),
        ]);
    }

    /**
     * Populate protected properties on init
     */
    public function __construct()
    {
        $this->title = __('facilitador::changes.controller.title');
        $this->description = __('facilitador::changes.controller.description');
        $this->columns = [
            __('facilitador::changes.controller.column.activity') => 'getAdminTitleHtmlAttribute',
        ];

        parent::__construct();
    }
}
