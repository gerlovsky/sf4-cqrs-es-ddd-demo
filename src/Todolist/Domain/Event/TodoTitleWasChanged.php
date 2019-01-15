<?php

namespace Todolist\Domain\Event;


use Todolist\Domain\TodoId;
use Todolist\Shared\AggregateId;
use Todolist\Shared\DomainEvent;

class TodoTitleWasChanged implements DomainEvent
{
    /**
     * @var \Todolist\Domain\TodoId
     */
    private $todoId;
    /**
     * @var string
     */
    private $title;

    /**
     * TodoTitleWasChanged constructor.
     *
     * @param \Todolist\Domain\TodoId $todoId
     * @param string $title
     */
    public function __construct(TodoId $todoId, string $title)
    {
        $this->todoId = $todoId;
        $this->title = $title;
    }

    public function getAggregateId(): AggregateId
    {
        return $this->todoId;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
}