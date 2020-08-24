<?php

namespace Facilitador\Models;

use App\Models\Model;
use App\Models\Negocio;
use App\Models\User;
use Translation\Models\Language;

class Setting extends Model
{
    
    // const CREATED_AT = 'data';
    // const UPDATED_AT = 'dataModificacao';

    protected $table = 'settings';

    protected $guarded = [];

    public $timestamps = false;

    protected $dispatchesEvents = [
        'updating' => SettingUpdated::class,
    ];

    protected static $organizationPerspective = true;

    public $incrementing = false;
    protected $casts = [
        'code' => 'string',
    ];
    protected $primaryKey = 'code';
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'value',
        'business_code'
    ];

    public function getAppAtribute($atribute)
    {
        $settingsDefault = self::settingsForNegocios();
        
        if (!isset($this->code)) {
            return false;
        }

        $array = $settingsDefault[$this->code];
        if (empty($array)) {
            return false;
        }

        return $array[$atribute];
    }

    public static function settingsForSubscriptions()
    {
        return [
            [
                'name' => 'Default Language',
                'description' => '',
                'code' => '',
                'options' => 'string',
                'defaultValue' => 'PT',
                'target' => \Illuminate\Support\Facades\Config::get('application.auth.model', \App\Models\User::class),
                'config' => null,
            ],
            [
                'name' => 'Default Money',
                'description' => '',
                'code' => '',
                'options' => 'string',
                'defaultValue' => 'BTC',
                'target' => \Illuminate\Support\Facades\Config::get('application.auth.model', \App\Models\User::class),
                'config' => null,
            ],
        ];
    }

    public static function settingsForNegocios()
    {
        return [

            /**
             * Personalização Froend
             */
            'business-website-app' => [
                'name' => 'Nome do App',
                'description' => 'Aparecerá no site',
                'options' => 'string',
                'defaultValue' => '',
                'target' => Negocio::class,
                'config' => "app.name",
            ],
            'business-website-description' => [
                'name' => 'Descrição do WebSite',
                'description' => '',
                'options' => 'string',
                'defaultValue' => '',
                'target' => Negocio::class,
                'config' => "app.description",
            ],
            'business-language' => [
                'name' => 'Linguagem padrão do App',
                'description' => '',
                'options' => 'select',
                'optionsValue' => Language::class,
                'defaultValue' => '',
                'target' => Negocio::class,
                'config' => "app.locale",
            ],
            'business-language-options' => [
                'name' => 'Linguagens habilitadas para a plataforma',
                'description' => '',
                'options' => 'selectMulti',
                'optionsValue' => Language::class,
                'defaultValue' => '',
                'target' => Negocio::class,
                'config' => "app.locale",
            ],
            'business-theme' => [
                'name' => 'Theme do Site',
                'description' => '',
                'options' => 'string',
                'defaultValue' => '',
                'target' => Negocio::class,
                'config' => "siravel.frontend-theme",
            ],


            /**
             * Personalização Bckend
             */
            'backoffice-title' => [
                'name' => 'Titulo do Backoffice',
                'description' => 'Aparecerá no canto superior esquerdo',
                'options' => 'string',
                'defaultValue' => env('APP_TITLE', 'Gpower'),
                'target' => Negocio::class,
                'config' => "adminlte.title",
            ],
            'backoffice-title_prefix' => [
                'name' => 'Prefixo do Tituto do Backoffice',
                'description' => 'Aparecerá no canto superior esquerdo',
                'options' => 'string',
                'defaultValue' => env('APP_TITLE_PREFIX', 'G'),
                'target' => Negocio::class,
                'config' => "adminlte.title_prefix",
            ],
            'backoffice-logo' => [
                'name' => 'Logo do Backoffice',
                'description' => 'Aparecerá no canto superior esquerdo',
                'options' => 'string',
                'defaultValue' => env('APP_TITLE_LOGO', '<b>G</b>Power'),
                'target' => Negocio::class,
                'config' => "adminlte.logo",
            ],
            // 'backoffice-logo_mini' => [
            //     'name' => 'MiniLogo do Backoffice',
            //     'description' => 'Aparecerá no canto superior esquerdo',
            //     'options' => 'string',
            //     'defaultValue' => '<b>C</b>MS',
            //     'target' => Negocio::class,
            //     'config' => "adminlte.logo_mini",
            // ],
            

            /**
             * Configurações Business
             */
            'can-register-free' => [
                'name' => 'Cadastro Gratis',
                'description' => 'Se o sistema permitirá que usuários se cadastrem gratuitamente no sistema',
                'options' => 'boolean',
                'defaultValue' => true,
                'target' => Negocio::class,
                'config' => "siravel.can_register_free",
            ],
            'terms' => [
                'name' => 'Termos e Condições',
                'description' => 'Termos e condições para cadstro de usuários',
                'options' => 'string',
                'defaultValue' => 'Não copie imagens',
                'target' => Negocio::class,
                'config' => "siravel.terms",
            ],


            /**
             * COnectividade - Serviços
             */
            'telegram_token' => [
                'name' => 'Telegram - Token',
                'description' => '',
                'options' => 'string',
                'defaultValue' => '',
                'target' => Negocio::class,
                'config' => "services.botman.telegram_token",
            ],
            'facebook_token' => [
                'name' => 'Facebook - Public Token',
                'description' => '',
                'options' => 'string',
                'defaultValue' => '',
                'target' => Negocio::class,
                'config' => "services.botman.facebook_token",
            ],
            'facebook_app_secret' => [
                'name' => 'Facebook - App Secret Token',
                'description' => '',
                'options' => 'string',
                'defaultValue' => '',
                'target' => Negocio::class,
                'config' => "services.botman.facebook_app_secret",
            ],
            'slack_token' => [
                'name' => 'Slack - Token',
                'description' => '',
                'options' => 'string',
                'defaultValue' => '',
                'target' => Negocio::class,
                'config' => "services.botman.slack_token",
            ],
        ];
    }

    public static function settingsForRoot()
    {
        return [
            'negocio-can-change-features' => [
                'name' => 'Negócio pode add ou remover Features ?',
                'description' => '',
                'options' => 'bool',
                'defaultValue' => true,
                'target' => Negocio::class,
                'config' => null,
            ],
            'negocio-can-change-plugins' => [
                'name' => 'Negócio pode add ou remover Plugins ?',
                'description' => '',
                'options' => 'bool',
                'defaultValue' => true,
                'target' => Negocio::class,
                'config' => null,
            ],
        ];
    }
}
