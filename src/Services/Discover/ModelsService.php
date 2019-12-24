<?php
/**
 * Serviço referente a linha no banco de dados
 */

namespace Facilitador\Services\Discover;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Support\Result\RelationshipResult;
use SierraTecnologia\Crypto\Services\Crypto;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Support\Discovers\Database\DatabaseUpdater;
use Support\Discovers\Database\Schema\Column;
use Support\Discovers\Database\Schema\Identifier;
use Support\Discovers\Database\Schema\SchemaManager;
use Support\Discovers\Database\Schema\Table;
use Support\Discovers\Database\Types\Type;

use Support\Discovers\Code\ComposerParser;

/**
 * ModelsService helper to make table and object form mapping easy.
 */
class ModelsService
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
