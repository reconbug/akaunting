<?php

namespace App\Listeners\Auth;

use Jenssegers\Date\Date;
use Illuminate\Auth\Events\Logout as ILogout;

class Logout
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param Logout $event
     * @return void
     */
    public function handle(ILogout $event)
    {
        if (empty($event->user)) {
            return;
        }
        
        $event->user->last_logged_in_at = Date::now();

        $event->user->save();

        session()->forget('company_id');
    }
}