<?php

return [

    'user_model' => \Illuminate\Support\Facades\Config::get('sitec.core.models.user', \App\Models\User::class),

    'message_model' => Facilitador\Models\Messenger\Message::class,

    'participant_model' => Facilitador\Models\Messenger\Participant::class,

    'thread_model' => Facilitador\Models\Messenger\Thread::class,

    /**
     * Define custom database table names - without prefixes.
     */
    'messages_table' => null,

    'participants_table' => null,

    'threads_table' => null,
];
