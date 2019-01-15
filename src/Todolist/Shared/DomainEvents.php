<?php

namespace Todolist\Shared;


use ArrayIterator;
use IteratorAggregate;

class DomainEvents implements IteratorAggregate
{
    /**
     * @var array|\Todolist\Shared\DomainEvent[]
     */
    private $events = [];

    public function __construct(array $events)
    {
        $this->events = $events;
    }

    public function getIterator()
    {
        return new ArrayIterator($this->events);
    }
}