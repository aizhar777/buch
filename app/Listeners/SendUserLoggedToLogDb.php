<?php

namespace App\Listeners;

use App\Events\UserIsLogged;
use App\Log as LogDb;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendUserLoggedToLogDb
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
     * @param  UserIsLogged  $event
     * @return void
     */
    public function handle(UserIsLogged $event)
    {
        //dd($event->userModel->name);
        LogDb::create([
            'log_type' => 'authorization',
            'description' => 'User named: '. ((!empty($event->userModel->name)) ? $event->userModel->name : 'No name') .' logged on',
            'user_id' => $event->userModel->id,
            'params' => null,
        ]);
    }
}
