<?php

namespace App\Policies;

use App\Models\JobAlert;
use App\Models\User;

class JobAlertPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, JobAlert $jobAlert): bool
    {
        return $user->id === $jobAlert->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, JobAlert $jobAlert): bool
    {
        return $user->id === $jobAlert->user_id;
    }

    // Optional: Allow creating job alerts
    public function create(User $user): bool
    {
        return true; // or any custom logic
    }

    // Optional: Allow viewing alerts
    public function view(User $user, JobAlert $jobAlert): bool
    {
        return $user->id === $jobAlert->user_id;
    }

    public function viewAny(User $user): bool
    {
        return true; // if users can view list of their alerts
    }
}
