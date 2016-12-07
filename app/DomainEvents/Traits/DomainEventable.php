<?php

namespace App\DomainEvents\Traits;

use eig\UUID\Facades\UUID;
use Carbon\Carbon;

trait DomainEventable
{
    protected $aggregate_id;

    protected $id;

    protected $fired_at;

    /**
     * getId
     * @return mixed
     */
    public function getId ()
    {
        return $this->id;
    }

    /**
     * getEvent
     * @return mixed
     */
    public function getEvent ()
    {
        return self::class;
    }

    /**
     * getAggregate
     * @return mixed
     */
    public function getAggregate ()
    {
        return $this->aggregate;
    }

    /**
     * getAggregateId
     * @return mixed
     */
    public function getAggregateId ()
    {
        return $this->aggregate_id;
    }

    /**
     * getPayload
     * @return mixed
     */
    public function getPayload ()
    {
        return $this;
    }

    /**
     * getFiredAt
     * @return mixed
     */
    public function getFiredAt ()
    {
        return $this->fired_at;
    }

    /**
     * initialize
     */
    protected function initialize()
    {
        $this->aggregate_id = UUID::generate()->toString();
        $this->id = UUID::generate();
        $this->fired_at = Carbon::now();
    }
}