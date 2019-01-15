<?php

namespace Todolist\Shared;


class DomainEventsHistory extends DomainEvents
{
    /**
     * @var \Todolist\Shared\AggregateId
     */
    private $aggregateId;

    public function __construct(AggregateId $aggregateId, $events)
    {
        $this->aggregateId = $aggregateId;

        parent::__construct($events);
    }

    /**
     * @return \Todolist\Shared\AggregateId
     */
    public function getAggregateId(): AggregateId
    {
        return $this->aggregateId;
    }
}