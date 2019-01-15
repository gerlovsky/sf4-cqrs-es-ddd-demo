<?php

namespace Todolist\Domain\Event;


use Todolist\Domain\TodoId;
use Todolist\Shared\AggregateId;
use Todolist\Shared\DomainEvent;

class TodoWasRemoved implements DomainEvent
{
    /**
     * @var \Todolist\Domain\TodoId
     */
    private $todoId;

    /**
     * TodoWasRemoved constructor.
     *
     * @param \Todolist\Domain\TodoId $todoId
     */
    public function __construct(TodoId $todoId)
    {
        $this->todoId = $todoId;
    }

    public function getAggregateId(): AggregateId
    {
        return $this->todoId;
    }
}