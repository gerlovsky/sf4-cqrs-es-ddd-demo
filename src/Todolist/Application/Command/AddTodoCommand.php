<?php

namespace Todolist\Application\Command;


use Todolist\Domain\TodoId;

class AddTodoCommand
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
     * AddTodoCommand constructor.
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

    /**
     * @return \Todolist\Domain\TodoId
     */
    public function getTodoId(): \Todolist\Domain\TodoId
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