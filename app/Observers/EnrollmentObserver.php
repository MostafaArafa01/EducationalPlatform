<?php

namespace App\Observers;

use App\Models\Enrollment;
use App\Models\User;
use App\Notifications\NewEnrollmentNotification;

class EnrollmentObserver
{
    /**
     * Handle the Enrollment "created" event.
     */
    public function created(Enrollment $enrollment): void
    {
        $user = $enrollment->user;
        $user->notify(new NewEnrollmentNotification());
    }

    /**
     * Handle the Enrollment "updated" event.
     */
    public function updated(Enrollment $enrollment): void
    {
        //
    }

    /**
     * Handle the Enrollment "deleted" event.
     */
    public function deleted(Enrollment $enrollment): void
    {
        //
    }

    /**
     * Handle the Enrollment "restored" event.
     */
    public function restored(Enrollment $enrollment): void
    {
        //
    }

    /**
     * Handle the Enrollment "force deleted" event.
     */
    public function forceDeleted(Enrollment $enrollment): void
    {
        //
    }
}
