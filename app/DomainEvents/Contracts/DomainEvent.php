<?php

namespace App\DomainEvents\Contracts;


/**
 * Interface DomainEvent
 * @package App\DomainEvents\Contracts
 */
interface DomainEvent
{

    /**
     * getId
     * @return mixed
     */
    public function getId();

    /**
     * getEvent
     * @return mixed
     */
    public function getEvent();

    /**
     * getAggregate
     * @return mixed
     */
    public function getAggregate();

    /**
     * getAggregateId
     * @return mixed
     */
    public function getAggregateId();

    /**
     * getPayload
     * @return mixed
     */
    public function getPayload();

    /**
     * getFiredAt
     * @return mixed
     */
    public function getFiredAt();
}