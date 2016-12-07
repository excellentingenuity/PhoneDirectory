<?php

namespace App\Listeners;

use App\Entries\Factory;
use App\Events\EntryCreationRequested;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EntryCreationRequestListener
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
     * @param  EntryCreationRequested  $event
     * @return void
     */
    public function handle(EntryCreationRequested $event)
    {
        Factory::create(
            $event->getAggregateId(),
            $event->last_name,
            $event->first_name,
            $event->phone
        );
    }
}
