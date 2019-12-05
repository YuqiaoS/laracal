<?php

namespace Calendar\Repositories;

use Calendar\User;
use Calendar\Task;

class EventRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        /*return Event::where('user_id', $user->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
                    */

        return $user->events->sortByDesc('event_date');
    }
}