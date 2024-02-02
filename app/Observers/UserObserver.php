<?php

namespace App\Observers;

use App\Mail\Login;
use App\Mail\LoginNotifications;
use App\Models\user;
use Illuminate\Support\Facades\Mail;

class UserObserver
{
    /**
     * Handle the user "created" event.
     */
    public function created(user $user): void
    {

    }

    /**
     * Handle the user "updated" event.
     */
    public function updated(user $user): void
    {
        //
    }

    /**
     * Handle the user "deleted" event.
     */
    public function deleted(user $user): void
    {
        //
    }

    public function login(user $user): void
    {
        Mail::to($user->email)->send(new LoginNotifications());
    }

    /**
     * Handle the user "restored" event.
     */
    public function restored(user $user): void
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     */
    public function forceDeleted(user $user): void
    {
        //
    }
}
