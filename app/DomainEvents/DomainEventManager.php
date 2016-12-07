<?php

namespace App\DomainEvents;

use App\DomainEvents\DomainEvent;
use App\DomainEvents\Contracts\DomainEvent as DomainEventContract;

/**
 * Class DomainEventManager
 * @package App\DomainEvents
 */
class DomainEventManager
{

    /**
     * record
     *
     * @param \App\DomainEvents\Contracts\DomainEvent $event
     */
    public static function record(DomainEventContract $event)
    {
        DomainEvent::record($event);
    }
}