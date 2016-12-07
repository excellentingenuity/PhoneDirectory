<?php

namespace App\Events;

use App\DomainEvents\Contracts\DomainEvent;
use App\DomainEvents\Traits\DomainEventable;
use Illuminate\Queue\SerializesModels;
use App\Entries\Entry;

class EntryUpdateRequested implements DomainEvent
{
    use DomainEventable, SerializesModels;

    public $last_name;

    public $first_name;

    public $phone;

    public $entry;

    protected $aggregate = 'App\Entries\Entry';

    /**
     * EntryUpdateRequested constructor.
     *
     * @param \App\Entries\Entry $entry
     * @param                    $last_name
     * @param                    $first_name
     * @param                    $phone
     */
    public function __construct(Entry $entry, $last_name, $first_name, $phone)
    {
        $this->initialize();
        $this->aggregate_id = $entry->id;
        $this->entry = $entry;
        $this->last_name = $last_name;
        $this->first_name = $first_name;
        $this->phone = $phone;
    }
}
