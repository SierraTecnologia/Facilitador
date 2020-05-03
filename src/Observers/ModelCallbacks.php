<?php

namespace Facilitador\Observers;

use Event;
use Log;
use Illuminate\Support\Str;
use Facilitador;
use Population\Models\Identity\Digital\Email;

use Support\Models\Base;

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

        if ($method == 'onCreating') {
            $this->runInCreating($model);
        }
        else if ($method == 'onCreated') {
            $this->runInCreated($model);
        }

        if (method_exists($model, $method)) {
            // dd($model, $method, $payload,  array_slice($payload, 1));
            // \Log::info('[Facilitador] ModelCallbacks: '.print_r($payload, true));
            return call_user_func_array([$model, $method], array_slice($payload, 1));
        }
    }

    /**
     * @todo
     */
    private function runInCreating($model)
    {
        // Faz porra nenhuma!
        return $model;
    }

    /**
     * @todo melhorar isso aqui refatorar
     */
    private function runInCreated($model)
    {
        $executeTo = [

        ];
        
        // If no author has been assigned, assign the current user's id as the author of the post
        if (isset($model->email) && !empty($model->email)) {
            $email = Email::createIfNotExistAndReturn($model->email);
            $email->associations(get_class($model))->save($model);
        }
        $this->linkToInfluencia($model);
    }

    /**
     * 
     */
    protected function linkToInfluencia($model)
    {
        if (!$influencia = Facilitador::getInfluencia()) {
            return false;
        }

        return Base::associate($influencia, $model);
    }


    /**
     * @todo Extrair isso aqui daqui
     */
    protected function getDontLog()
    {
        return config('sitec.audit.dontLog');
    }

    protected function getDontLogAlias()
    {
        return config('sitec.audit.dontLogAlias');
    }
}
