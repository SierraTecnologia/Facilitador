<?php

namespace Facilitador\Observers;

use Event;
use Log;
use Illuminate\Support\Str;
use Facilitador;

/**
 * Call no-op classes on models for all event types.  This just simplifies
 * the handling of model events for models.
 */
class ModelCallbacks
{
    /**
     * Handle all model events, both Eloquent and Decoy
     *
     * @param  string $event
     * @param  array $payload Contains:
     *    - Facilitador\Models\Base $model
     * @return void
     */
    public function handle($event, $payload)
    {
        list($model) = $payload;

        // // Payload
        // ^ Cmgmyr\Messenger\Models\Message^ {#4332
        //     #table: "messages"
        //     #touches: array:1 [
        //       0 => "thread"
        //     ]
        //     #fillable: array:3 [
        //       0 => "thread_id"
        //       1 => "user_id"
        //       2 => "body"
        //     ]
        //     #dates: array:1 [
        //       0 => "deleted_at"
        //     ]
        //     #connection: null
        //     #primaryKey: "id"
        //     #keyType: "int"
        //     +incrementing: true
        //     #with: []
        //     #withCount: []
        //     #perPage: 15
        //     +exists: false
        //     +wasRecentlyCreated: false
        //     #attributes: []
        //     #original: []
        //     #changes: []
        //     #casts: []
        //     #dateFormat: null
        //     #appends: []
        //     #dispatchesEvents: []
        //     #observables: []
        //     #relations: []
        //     +timestamps: true
        //     #hidden: []
        //     #visible: []
        //     #guarded: array:1 [
        //       0 => "*"
        //     ]
        //     #forceDeleting: false
        //   }
          

        // Get the action from the event name
        preg_match('#\.(\w+)#', $event, $matches);
        $action = $matches[1];

        // If there is matching callback method on the model, call it, passing
        // any additional event arguments to it
        $method = 'on'.Str::studly($action);

        if ($method == 'onCreated') {
            $this->linkToInfluencia($model);
        }

        if (method_exists($model, $method)) {
            return call_user_func_array([$model, $method], array_slice($payload, 1));
        }
    }

    /**
     * 
     */
    protected function linkToInfluencia($model)
    {
        if (!$influencia = Facilitador::getInfluencia()) {
            return false;
        }
        $method = Str::plural(Str::lower(class_basename($model)));

        
        if (method_exists($influencia, $method)) {
            return call_user_func_array([$influencia, $method], [])->save($model);
        }
        // @todo Resolver isso, o log faz o calbback ficar em looping infinito
        //Log::warning('Facilitador Influencia não encontrou o metodo '.$method.' na classe '.class_basename($influencia));
        return false;
    }
}
