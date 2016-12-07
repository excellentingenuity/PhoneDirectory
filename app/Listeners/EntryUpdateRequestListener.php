<?php

namespace App\Listeners;

use App\Entries\Manager;
use App\Events\EntryUpdateRequested;

class EntryUpdateRequestListener
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
     * @param  EntryUpdateRequested  $event
     * @return void
     */
    public function handle(EntryUpdateRequested $event)
    {
        Manager::update($event->entry, $event->last_name, $event->first_name, $event->phone);
    }
}
