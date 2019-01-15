<?php

namespace Todolist\Domain\Event;


use Todolist\Domain\TodoId;
use Todolist\Shared\AggregateId;
use Todolist\Shared\DomainEvent;

class TodoDescriptionWasChanged implements DomainEvent
{
    /**
     * @var \Todolist\Domain\TodoId
     */
    private $todoId;
    /**
     * @var string
     */
    private $description;

    /**
     * TodoTitleWasChanged constructor.
     *
     * @param \Todolist\Domain\TodoId $todoId
     * @param string $description
     */
    public function __construct(TodoId $todoId, string $description)
    {
        $this->todoId = $todoId;
        $this->description = $description;
    }

    public function getAggregateId(): AggregateId
    {
        return $this->todoId;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}