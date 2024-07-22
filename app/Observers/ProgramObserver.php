<?php

namespace App\Observers;

use App\Models\Program;
use App\Models\User;

class ProgramObserver
{
    /**
     * Handle the Program "created" event.
     */
    public function created(Program $program): void
    {
        $user = $program->user;
        $this->addExperience($user, rand(30, 50));
    }

    private function addExperience(User $user, int $amount): void
    {
        $user->experience += $amount;
        $levelsGained = floor($user->experience / 100);

        if ($levelsGained > 0) {
            $user->level += $levelsGained;
            $user->experience %= 100;
        }

        $user->save();
    }


    /**
     * Handle the Program "updated" event.
     */
    public function updated(Program $program): void
    {
        //
    }

    /**
     * Handle the Program "deleted" event.
     */
    public function deleted(Program $program): void
    {
        //
    }

    /**
     * Handle the Program "restored" event.
     */
    public function restored(Program $program): void
    {
        //
    }

    /**
     * Handle the Program "force deleted" event.
     */
    public function forceDeleted(Program $program): void
    {
        //
    }
}
