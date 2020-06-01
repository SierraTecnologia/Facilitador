<?php

return [

    'user_model' => \Illuminate\Support\Facades\Config::get('sitec.core.models.user', \App\Models\User::class),

    'message_model' => Population\Models\Features\Messenger\Message::class,

    'participant_model' => Population\Models\Features\Messenger\Participant::class,

    'thread_model' => Population\Models\Features\Messenger\Thread::class,

    /**
     * Define custom database table names - without prefixes.
     */
    'messages_table' => null,

    'participants_table' => null,

    'threads_table' => null,
];
