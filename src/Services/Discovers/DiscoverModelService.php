<?php
/**
 * Serviço referente a linha no banco de dados
 */

namespace Facilitador\Services\Discovers;

use SierraTecnologia\Crypto\Services\Crypto;
use Illuminate\Http\Request;
use Support\Eloquent\Relationships;
use App;
use Log;
use Exception;
use Artisan;
use Illuminate\Support\Collection;
use Support\Entities\DataTypes\Varchar;
use Support\Eloquent\EloquentColumn;
use ReflectionClass;
use TCG\Voyager\Database\Schema\SchemaManager;

/**
 * ModelService helper to make table and object form mapping easy.
 */
class DiscoverModelService
{
    protected $schemaManagerTable = false;
    protected $modelClass;

    public function __construct($modelClass = false)
    {
        if ($this->modelClass = $modelClass) {
            $this->renderTableInfos();
        }
    }

    /**
     * Trabalhos Pesados
     */
    public function getRelations($key = false)
    {
        // dd($key, (new Relationships($this->modelClass)),(new Relationships($this->modelClass))($key));
        return (new Relationships($this->modelClass))($key);
    }
    private function renderTableInfos()
    {
        $this->schemaManagerTable = SchemaManager::listTableDetails($this->getTableName());

        // $data = [
        //     $this->getRelations(),
        //     $this->schemaManagerTable
        // ];
        // dd($data);
    }

    /**
     * Relações
     */
    public function getAtributes()
    {
        // dd(\Schema::getColumnListing($this->modelClass));
        $fillables = collect(App::make($this->modelClass)->getFillable())->map(function ($value) {
            return new EloquentColumn($value, new Varchar, true);
        });
        return $fillables;
    }

    /**
     * Caracteristicas das Tabelas
     */
    public function getPrimaryKey()
    {
        return App::make($this->modelClass)->getKeyName();
    }
    public function getColumns()
    {
        // dd($this->getAtributes(), $this->schemaManagerTable->getColumns());
        return $this->schemaManagerTable->getColumns();
    }




    /**
     * Helpers
     */
    public function getTableName()
    {
        $name = $this->modelClass;
        Log::warning($name);

        if (!class_exists($name)) {
            throw new Exception('Class não encontrada no ModelService' . $name);
        }

        $model = new $name;
        return $model->getTable();
    }


    /**
     * Modulos
     */
    public function getModules()
    {
        $columns = $this->getRelations();
    }
}
