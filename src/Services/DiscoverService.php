<?php
/**
 * Serviço referente a linha no banco de dados
 * @todo Fazer Aqui
 */

namespace Facilitador\Services;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Support\Result\RelationshipResult;
use SierraTecnologia\Crypto\Services\Crypto;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Support\Coder\Discovers\Database\DatabaseUpdater;
use Support\Coder\Discovers\Database\Schema\Column;
use Support\Coder\Discovers\Database\Schema\Identifier;
use Support\Coder\Discovers\Database\Schema\SchemaManager;
use Support\Coder\Discovers\Database\Schema\Table;
use Support\Coder\Discovers\Database\Types\Type;

use Support\Coder\Parser\ComposerParser;

/**
 * DiscoverService helper to make table and object form mapping easy.
 */
class DiscoverService
{

    protected $identify;
    protected $instance;
    protected $repositoryService = false;

    public function __construct()
    {
        $composerParser = new ComposerParser;
        
        $models = config('sitec.discover.models_alias');

        dd($composerParser->returnClassesByAlias($models));

        dd(SchemaManager::listTableNames());
        
    }

    public function getRoutes()
    {
        $routeCollection = Route::getRoutes();

        foreach ($routeCollection as $value) {
            echo $value->getPath();
        }
    }
}
