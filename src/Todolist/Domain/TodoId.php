<?php

namespace Todolist\Domain;


use Todolist\Shared\AggregateId;
use Todolist\Shared\UUIDGenerator;

class TodoId implements AggregateId
{
    private $todoId;

    public static function generate(): TodoId
    {
        return new TodoId(UUIDGenerator::generate());
    }

    /**
     * TodoId constructor.
     *
     * @param string $todoId
     */
    public function __construct(string $todoId)
    {
        $this->todoId = $todoId;
    }

    public static function fromString(string $todoId)
    {
        return new TodoId($todoId);
    }

    public function __toString()
    {
        return (string) $this->todoId;
    }

    public function equals(AggregateId $other)
    {
        return $other instanceof TodoId && $other->__toString() === $this->__toString();
    }
}