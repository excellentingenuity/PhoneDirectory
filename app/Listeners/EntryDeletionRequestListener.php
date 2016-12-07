<?php

namespace App\Listeners;

use App\Entries\Manager;
use App\Events\EntryDeletionRequested;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EntryDeletionRequestListener
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
     * @param  EntryDeletionRequested  $event
     * @return void
     */
    public function handle(EntryDeletionRequested $event)
    {
        Manager::delete($event->entry);
    }
}
