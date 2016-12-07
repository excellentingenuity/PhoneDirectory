<?php

namespace App\Events;

use App\DomainEvents\Contracts\DomainEvent;
use App\DomainEvents\Traits\DomainEventable;
use App\Entries\Entry;
use Illuminate\Queue\SerializesModels;



class EntryDeletionRequested implements DomainEvent
{
    use DomainEventable, SerializesModels;

    public $entry;

    protected $aggregate = 'App\Entries\Entry';

    /**
     * EntryDeletionRequested constructor.
     *
     * @param \App\Entries\Entry $entry
     */
    public function __construct(Entry $entry)
    {
        $this->initialize();
        $this->aggregate_id = $entry->id;
        $this->entry = $entry;
    }

}
