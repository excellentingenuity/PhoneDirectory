<?php

namespace App\Listeners;

use App\DomainEvents\Contracts\DomainEvent;
use App\DomainEvents\DomainEventManager;


class DomainEventListener
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
     * @param  DomainEvent $event
     * @return void
     */
    public function handle(DomainEvent $event)
    {
        DomainEventManager::record($event);
    }
}
