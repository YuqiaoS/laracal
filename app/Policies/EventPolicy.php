<?php

namespace Calendar\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Calendar\Event;
use Calendar\User;

class EventPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    /**
     * Determine if the given user can delete the given event.
     *
     * @param  User  $user
     * @param  Event  $event
     * @return bool
     */
    public function destroy(User $user, Event $event)
    {
        //should be a method that automatically checks the id against the foreign id
        return $user->id === $event->user_id;
    }
}
