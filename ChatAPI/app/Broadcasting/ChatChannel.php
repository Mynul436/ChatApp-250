<?php

namespace App\Broadcasting;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Auth\Authenticatable;

class ChatChannel
{
    /**
     * Create a new channel instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     */
    public function join(Authenticatable $user, $channelId)
    {
        if ($user->canJoinChannel($channelId)) {
            return ['channel_id' => $channelId];
        }

        throw new AuthorizationException('You are not authorized to join this channel.');
    }


    
}
