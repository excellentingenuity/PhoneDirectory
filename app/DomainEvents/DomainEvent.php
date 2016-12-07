<?php

namespace App\DomainEvents;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\DomainEvents\Contracts\DomainEvent as DomainEventContract;

/**
 * Class DomainEvent
 * @package App\DomainEvents
 */
class DomainEvent extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $dates = ['deleted_at', 'fired_at'];

    /**
     * @var array
     */
    protected $fillable = ['id', 'event', 'aggregate', 'aggregate_id', 'payload', 'fired_at'];

    /**
     * record
     *
     * @param \App\DomainEvents\Contracts\DomainEvent $event
     *
     * @return static
     */
    public static function record(DomainEventContract $event)
    {
        $record = self::create([
                                   'id' => $event->getId(),
                                   'event' => $event->getEvent(),
                                   'aggregate' => $event->getAggregate(),
                                   'aggregate_id' => $event->getAggregateId(),
                                   'payload' => json_encode($event->getPayload()),
                                   'fired_at' => $event->getFiredAt()
                               ]);
        $record->save();
        return $record;
    }


}