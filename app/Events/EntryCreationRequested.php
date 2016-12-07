<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use App\DomainEvents\Contracts\DomainEvent;
use App\DomainEvents\Traits\DomainEventable;

class EntryCreationRequested implements DomainEvent
{
    use DomainEventable, SerializesModels;

    public $last_name;

    public $first_name;

    public $phone;

    protected $aggregate = 'App\Entries\Entry';

    /**
     * EntryCreationRequested constructor.
     *
     * @param $last_name
     * @param $first_name
     * @param $phone
     *
     */
    public function __construct($last_name, $first_name, $phone)
    {
        $this->initialize();
        $this->last_name = $last_name;
        $this->first_name = $first_name;
        $this->phone = $phone;
    }
}
