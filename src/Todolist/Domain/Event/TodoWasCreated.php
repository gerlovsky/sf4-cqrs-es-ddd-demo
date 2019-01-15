<?php

namespace Todolist\Domain\Event;


use Todolist\Domain\TodoId;
use Todolist\Shared\AggregateId;
use Todolist\Shared\DomainEvent;

class TodoWasCreated implements DomainEvent
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
     * @var string
     */
    private $description;

    /**
     * TodoWasCreated constructor.
     *
     * @param \Todolist\Domain\TodoId $todoId
     * @param string $title
     * @param string $description
     */
    public function __construct(TodoId $todoId, string $title, string $description)
    {
        $this->todoId = $todoId;
        $this->title = $title;
        $this->description = $description;
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

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}