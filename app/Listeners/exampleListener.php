<?php

namespace App\Listeners;

use App\Events\exampleEvent;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class exampleListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(exampleEvent $event): void
    {
        Log::debug("The user {$event->username} performed {$event->action}");
    }
}
