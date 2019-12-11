<?php

namespace Facilitador\Http\Controllers\Decoy;

/**
 * Allow admin to manage redirection rules
 */
class RedirectRules extends Base
{
    /**
     * @var string
     */
    protected $title = 'Redirects';

    /**
     * @var string
     */
    protected $description = 'Rules that redirect an internal URL path to another.';

    /**
     * @var array
     */
    protected $columns = [
        'Rule' => 'getAdminTitleAttribute',
    ];

    /**
     * @var array
     */
    protected $search = [
        'from',
        'to',
        'code' => [
            'type' => 'select',
            'options' => 'Facilitador\Models\RedirectRule::getCodes()',
        ],
        'label',
    ];

    /**
     * Get the permission options.
     *
     * @return array An associative array.
     */
    public function getPermissionOptions()
    {
        return array_except(parent::getPermissionOptions(), ['publish']);
    }

    /**
     * Populate protected properties on init
     */
    public function __construct()
    {
        $this->title = __('facilitador::redirect_rules.controller.title');
        $this->description = __('facilitador::redirect_rules.controller.description');
        $this->columns = [
            __('facilitador::redirect_rules.controller.column.rule') => 'getAdminTitleAttribute',
        ];
        $this->search = [
            'from' => [
                'label' => __('facilitador::redirect_rules.controller.search.from'),
                'type' => 'text',
            ],
            'to' => [
                'label' => __('facilitador::redirect_rules.controller.search.to'),
                'type' => 'text',
            ],
            'code' => [
                'label' => __('facilitador::redirect_rules.controller.search.code'),
                'type' => 'select',
                'options' => 'Facilitador\Models\RedirectRule::getCodes()',
            ],
            'label' => [
                'label' => __('facilitador::redirect_rules.controller.search.label'),
                'type' => 'text',
            ],
        ];

        parent::__construct();
    }
}
