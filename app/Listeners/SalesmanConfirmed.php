<?php

namespace App\Listeners;

use App\Events\Salesman;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;

class SalesmanConfirmed
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
     * @param  \App\Events\Salesman.php  $event
     * @return void
     */
    public function handle(Salesman $event)
    {
        $user = User::find($event->saleman->user_id)->first();
        $user->role_id = 3;
        $user->save();
    }
}
