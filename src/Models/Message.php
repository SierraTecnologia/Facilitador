<?php

namespace Facilitador\Models;

// use Cmgmyr\Messenger\Models\Message as BaseMessage;
use Facilitador\Models\Messenger\Message as BaseMessage;

class Message extends BaseMessage
{
    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}